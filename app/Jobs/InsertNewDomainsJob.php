<?php

namespace App\Jobs;

use App\Models\DomainInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class InsertNewDomainsJob implements ShouldQueue
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
    public function handle(): void
    {
        // Find existing domains
        $existingDomains = DomainInfo::whereIn('domain_name', $this->domains)->pluck('domain_name')->toArray();
        $newDomains = array_diff($this->domains, $existingDomains);
    
        if (!empty($newDomains)) {
            DB::transaction(function () use (&$newDomains) {
                // Lock the table to prevent parallel modification of the count column
                $maxCount = DB::table('domain_info')
                    ->whereNotNull('count')
                    ->lockForUpdate()
                    ->max('count') ?? 0;
    
                $insertData = [];
                foreach ($newDomains as $domain) {
                    $maxCount++; // Ensure each new domain gets a unique count
                    $insertData[] = [
                        'domain_name' => $domain,
                        'status'      => 'inprogress',
                        'count'       => $maxCount,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }
    
                // Bulk insert new domains inside the transaction
                DomainInfo::insert($insertData);
            });
    
            // Dispatch the second job only if new domains were inserted
            ScrapeAndCategorizeJob::dispatch($newDomains);
        }
    }    
}
