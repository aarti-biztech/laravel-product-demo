<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name', 'description','price','image','category_id'
    ];
    public $sortable = ['name','price'];
}
