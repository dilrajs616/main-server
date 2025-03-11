<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainInfo extends Model
{
    use HasFactory;

    protected $table = 'domain_info'; // Explicitly define the table name
    protected $primaryKey = 'domain_name'; // Set the primary key
    public $incrementing = false; // Disable auto-incrementing for the primary key
    protected $keyType = 'string'; // Set the primary key type

    protected $fillable = [
        'domain_name',
        'is_subdomain',
        'main_domain',
        'status',
        'count',
    ];
}