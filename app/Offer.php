<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title', 'description', 'long_description', 'page_url', 'img_url', 'brand', 'country', 'type', 'status', 'price', 'currency'
    ];

    protected $table = 'offers';

    public function users(){
        return $this->belongsToMany('App\User', 'offer_user', 'offer_id', 'user_id');
    }
}
