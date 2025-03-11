<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    use HasFactory;

    protected $table = 'auth_tokens'; // Explicitly define the table name
    protected $primaryKey = 'id'; // Set the primary key
    public $incrementing = true; // Enable auto-incrementing for the primary key
    protected $keyType = 'int'; // Set the primary key type

    protected $fillable = [
        'token', // The authentication token
    ];
}