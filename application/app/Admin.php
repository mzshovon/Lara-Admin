<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}




