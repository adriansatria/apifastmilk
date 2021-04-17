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
        'user_id',
        'categories_product_id',
        'product_sku',
        'product_name',
        'product_price',
        'product_weight',
        'description',
        'product_shortdesk',
        'product_image',
        'product_update_date',
        'product_stock'
    ];

    public function Users(){
        return $this->belongTo(User::class);
    }

    public function ProductsCategories(){
        return $this->hasMany(ProductsCategories::class);
    }
}
