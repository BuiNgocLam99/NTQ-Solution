<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'slug',
        'code_product',
        'title',
        'thumnail',
        'images',
        'status',
        'reference_product',
        'description',
        'shop_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function productVariable()
    {
        return $this->hasMany(ProductVariable::class);
    }
}
