<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function offers()
    {
        return $this->belongsToMany('App\Offer', 'offer_user', 'offer_id', 'user_id');
    }
}
