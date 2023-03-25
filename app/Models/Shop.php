<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone_number',
        'avatar',
        'description',
        'password',
        'zipcode',
        'city',
        'country',
    ];

    public function product() {
        return $this->hasMany(Product::class);
    }
}
