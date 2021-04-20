<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'products';

    protected $fillable = [
        'categories_product_id',
        'product_name',
        'product_price',
        'product_weight',
        'product_taste',
        'description',
        'product_image',
        'product_update_date',
        'product_stock'
    ];

    public function ProductsCategories(){
        return $this->hasMany(ProductsCategories::class);
    }
    public function Pesanan(){
        return $this->hasMany(Pesanan::class);
    }
}
