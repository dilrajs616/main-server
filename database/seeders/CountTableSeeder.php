<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Count;
use App\Models\DomainInfo;

class CountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $totalRows = DomainInfo::count(); // Get the total number of rows in domain_info
        Count::create(['total_rows' => $totalRows]); // Insert the count into the count table
    }
}
