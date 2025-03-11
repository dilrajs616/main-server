<?php

namespace App\Jobs;

use App\Models\DomainInfo;
use App\Models\HistoryTable;
use App\Models\DomainCategoryViaLlama;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ScrapeAndCategorizeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $domains;

    /**
     * Create a new job instance.
     */
    public function __construct(array $domains)
    {
        $this->domains = $domains;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            // Send request to the external scraping and categorization API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withOptions(['stream' => true]) // Enable streaming
            ->post('http://10.1.1.175:8000/scrape-categorize', [
                'domains' => $this->domains,
            ]);
    
            // Manually read the response line by line
            $body = $response->body();  // Get raw response body
    
            foreach (explode("\n", $body) as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }
                
                Log::info("Raw response line: " . $line);

                $data = json_decode($line, true);
                if ($data === null) {
                    Log::error("Invalid JSON response from scraper: $line");
                    continue;
                }
    
                if (!isset($data['data'])) {
                    Log::warning('Unexpected response format', ['response' => $data]);
                    continue;
                }
    
                $site = $data['data']['site'];
                $message = $data['data']['message'] ?? null;
    
                // Default values
                $finalUrl = null;
                $language = null;
                $country = null;
                $isSubdomain = 0;
                $mainDomain = null;
                $categoryId = null;
                $categorized = ['Category' => 'Uncategorized', 'Alternate Category' => ''];
    
                // Handle failed cases
                if ($message) {
                    Log::error("Scraping failed for $site: $message");
                    // Assign the "Uncategorized" category
                    $uncategorized = Category::where('name', 'Uncategorized')->first();

                    if ($uncategorized) {
                        $categoryId = $uncategorized->group_id;
                        $subcategoryId = $uncategorized->id;
                    } else {
                        Log::error('Uncategorized category not found in database!');
                        $categoryId = null;
                        $subcategoryId = null;
                    }
                } else {
                    // If scraping succeeded, extract values
                    $finalUrl = $data['data']['final_url'];
                    $language = $data['data']['language'];
                    $country = $data['data']['country'];
                    $isSubdomain = $data['data']['sub_domain'];
                    $mainDomain = $data['data']['domain'] === 'N/A' ? null : $data['data']['domain'];
                    $categorized = json_decode($data['data']['categorized'], true);
    
                    // Find or create category
                    $category = Category::where('name', $categorized['Category'])->first();
    
                    if ($category) {
                        Log::info("Fetched Category from DB:", $category->toArray());
                        $categoryId = $category->group_id;
                        $subcategoryId = $category->id;
                    } else {
                        // If category does not exist, assign it to "Uncategorized"
                        $uncategorized = Category::firstOrCreate(
                            ['name' => 'Uncategorized'],
                            ['group_id' => 0, 'created_at' => now(), 'updated_at' => now()]
                        );
                        $categoryId = $uncategorized->group_id;
                        $subcategoryId = $uncategorized->group_id;
                    }
                }

                Log::info("Processing $site => category_id: $categoryId, subcategory_id: $subcategoryId");
                
                // Update domain_info table
                DomainInfo::where('domain_name', $site)->update([
                    'status' => 'finished',
                    'is_subdomain' => $isSubdomain, // Default
                    'main_domain' => $mainDomain, // Default
                ]);
    
                // Insert into history_table
                HistoryTable::where('domain_id', $site)->update([
                    'is_subdomain' => $isSubdomain, 
                    'main_domain' => $mainDomain, 
                    'redirected_to' => $finalUrl,
                    'country' => $country,
                    'language' => $language,
                    'time_of_scraping' => now(),
                    'is_changed' => 0,
                ]);
    
                // Insert into domain_category_via_llama
                DomainCategoryViaLlama::create([
                    'domain_name' => $site,
                    'category_id' => $categoryId,
                    'subcategory_id' => $subcategoryId,
                    'time' => now(),
                ]);
    
                Log::info("Successfully processed $site");
            }
    
        } catch (\Exception $e) {
            Log::error('ScrapeAndCategorizeJob failed', ['error' => $e->getMessage()]);
        }
    }    
}
