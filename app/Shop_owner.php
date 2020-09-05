<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_permission;

class Shop_owner extends Model
{
    static public function create_new()
    {

        $owner = new self();
        $owner->user_id = auth()->user()->id;
        $owner->save();
    }


    public function shops()
    {
        return $this->hasMany('App\Shop');
    }
}