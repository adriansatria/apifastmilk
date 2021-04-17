<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategories extends Model
{
    use HasFactory;

    protected $table = 'productscategories';

    protected $fillable = [
     'product_category_id',
     'categories_name'
    ];

    public function Products(){
        return $this->belongsTo(Products::class);
    }
}
