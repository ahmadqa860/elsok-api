<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'created_at', 'updated_at'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->hasOne('App\Seller');
    }

    public function shopOwner()
    {
        return $this->hasOne('App\Shop_owner');
    }

    public function hasPermissions()
    {
        return $this->hasMany('App\User_permission');
    }

    public function hasProfile()
    {
        return $this->hasOne('App\Profile');
    }
}