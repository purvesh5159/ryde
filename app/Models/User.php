<?php
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens; // Passport trait for OAuth
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasApiTokens, Notifiable;
    protected $connection = 'mongodb';
    protected $collection = 'users';

     protected $fillable = [
        'name', 'email', 'password', 'dob', 'address', 'description', 'friends', 'coordinates'
    ];

    protected $casts = [
        'friends' => 'array',
        'coordinates' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}