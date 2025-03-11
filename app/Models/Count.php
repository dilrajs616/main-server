<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    use HasFactory;

    protected $table = 'count'; // Explicitly define the table name
    protected $fillable = ['total_rows']; // Define fillable fields
}