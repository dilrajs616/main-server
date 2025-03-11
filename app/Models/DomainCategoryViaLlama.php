<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainCategoryViaLlama extends Model
{
    use HasFactory;

    protected $table = 'domain_category_via_llama'; // Explicitly define the table name
    protected $fillable = [
        'domain_name',
        'category_id',
        'subcategory_id',
        'time',
    ];

    // Define the relationship with the DomainInfo model
    public function domain()
    {
        return $this->belongsTo(DomainInfo::class, 'domain_name', 'domain_name');
    }

    // Define the relationship with the Category model
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_id', 'id');
    }

    // Define the relationship with the Category model for subcategories
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

}
