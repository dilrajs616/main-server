<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthToken;
use App\Models\DomainInfo;
use App\Models\Count;
use Illuminate\Support\Facades\Http;
use App\Jobs\InsertNewDomainsJob;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function processDomains(Request $request)
    {
        $token = $request->input('token');
        $domainsString = $request->input('domains');

        // Validate token
        if (!AuthToken::where('token', $token)->exists()) {
            return response()->json(['error' => 'Invalid authentication token'], 401);
        }        

        // Convert domains string to array
        $domains = array_map('trim', explode(',', $domainsString));

        // Process domains asynchronously
        InsertNewDomainsJob::dispatch($domains);

        // Return response immediately
        return response()->json(['message' => 'Processing started']);
    }

    public function fetchDomains(Request $request)
    {
        $token = $request->input('token');
        $count = $request->input('count');
    
        // Validate token
        if (!AuthToken::where('token', $token)->exists()) {
            return response()->json(['error' => 'Invalid authentication token'], 401);
        }
    
        // Fetch domains with count greater than given count and status finished
        $domains = DomainInfo::where('count', '>', $count)
            ->where('status', 'finished')
            ->pluck('domain_name');
    
        if ($domains->isEmpty()) {
            return response()->json(['message' => 'No new domains available', 'data' => [], 'count' => $count]);
        }
    
        // Fetch category_id for each domain
        $domainCategories = DB::table('domain_category_via_llama')
            ->whereIn('domain_name', $domains)
            ->pluck('group_id', 'domain_name')
            ->mapWithKeys(function ($category_id, $domain) {
                // Remove http:// or https:// from domain names
                $cleanDomain = preg_replace('/^https?:\/\//', '', $domain);
                return [$cleanDomain => $category_id];
            });
    
        // Get max count where status is finished
        $maxCount = DomainInfo::where('status', 'finished')->max('count') ?? $count;
    
        return response()->json(['data' => $domainCategories, 'count' => $maxCount]);
    }
    
}
