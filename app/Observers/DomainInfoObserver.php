<?php

namespace App\Observers;

use App\Models\DomainInfo;
use App\Models\Count;

class DomainInfoObserver
{
    public function created(DomainInfo $domainInfo)
    {
        // Increment the total_rows count in the count table
        $count = Count::first();
        if ($count) {
            $count->increment('total_rows');
        } else {
            Count::create(['total_rows' => 1]);
        }
    }

    public function deleted(DomainInfo $domainInfo)
    {
        // Decrement the total_rows count in the count table
        $count = Count::first();
        if ($count && $count->total_rows > 0) {
            $count->decrement('total_rows');
        }
    }
}