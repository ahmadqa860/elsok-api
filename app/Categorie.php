<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function categoryProducts()
    {
        return $this->hasMany('App\Product');
    }
}