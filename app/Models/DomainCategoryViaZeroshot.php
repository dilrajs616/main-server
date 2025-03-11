<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainCategoryViaZeroshot extends Model
{
    use HasFactory;

    protected $table = 'domain_category_via_zeroshot'; // Explicitly define the table name
    protected $fillable = [
        'domain_name',
        'category_id',
        'time',
    ];

    // Define the relationship with the DomainInfo model
    public function domain()
    {
        return $this->belongsTo(DomainInfo::class, 'domain_name', 'domain_name');
    }

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'group_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }
}