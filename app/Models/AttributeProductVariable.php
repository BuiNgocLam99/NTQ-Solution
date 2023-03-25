<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProductVariable extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_value_id',
        'product_variable_id',
    ];
}
