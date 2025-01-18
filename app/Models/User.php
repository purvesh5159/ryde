<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'dob',
        'address',
        'description',
    ];

    protected $dates = [
        'dob',
        'createdAt',
    ];
}