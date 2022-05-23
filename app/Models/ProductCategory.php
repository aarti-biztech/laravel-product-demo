<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name', 'category_description'
    ];

    public function scopeProductCategories()
    {
        $categories = self::all();
        $categories_array = array();
        foreach ($categories as $key => $category) {
            $categories_array[$category->id] = $category->category_name;
        }
        return $categories_array;
    }
}
