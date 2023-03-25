<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariable extends Model
{
    protected $table = 'product_variables';

    protected $fillable = [
        'product_code',
        'product_id',
        'import_price',
        'regular_price',
        'sale_price',
        'tax',
        'order_counts',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
