<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTable extends Model
{
    use HasFactory;

    protected $table = 'history_table'; // Explicitly define the table name
    protected $primaryKey = 'record_id'; // Set the primary key
    public $incrementing = true; // Enable auto-incrementing for the primary key
    protected $keyType = 'int'; // Set the primary key type

    protected $fillable = [
        'domain_id',
        'is_subdomain',
        'main_domain',
        'redirected_to',
        'country',
        'language',
        'time_of_scraping',
        'is_changed',
    ];
}
