<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    static public function create_new()
    {
        $seller = new self();
        $seller->user_id = auth()->user()->id;
        $seller->save();
    }

    public function sellerProducts()
    {
        return $this->hasMany('App\Product');
    }
}