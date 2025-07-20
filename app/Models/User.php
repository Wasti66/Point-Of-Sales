<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable =[
        'firstName',
        'lastName',
        'userName',
        'password',
        'email',
        'phone',
        'images',
        'otp
    '];
    protected $attributes = [
        'otp'=>'0',
        'images'=>'nullable'
    ];
    protected $hidden = [
        'created_at',
        'updated-at',
    ];

    use HasFactory;

}
