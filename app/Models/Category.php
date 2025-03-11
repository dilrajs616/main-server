<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Explicitly define the table name
    protected $fillable = [
        'name',
        'group_id'
    ];

    // Define the relationship with CategoryGroup
    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'group_id');
    }

    // Define the relationship with the DomainCategoryViaLlama model
    public function domainCategoryViaLlama()
    {
        return $this->hasMany(DomainCategoryViaLlama::class, 'category_id', 'group_id');
    }

    // Define the relationship with the DomainCategoryViaZeroshot model
    public function domainCategoryViaZeroshot()
    {
        return $this->hasMany(DomainCategoryViaZeroshot::class, 'category_id', 'group_id');
    }
}