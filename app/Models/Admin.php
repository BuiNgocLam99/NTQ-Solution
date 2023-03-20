<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'slug',
        'fullname',
        'position',
        'email',
        'phone_number',
        'avatar',
        'password',
        'dob',
    ];
}
