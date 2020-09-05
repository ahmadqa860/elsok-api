<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product_image;

class Product extends Model
{

    static public function create_new($request)
    {
        $product = new self();
        $product->seller_id = auth()->user()->seller->id;
        $product->categorie_id = $request['categorie_id'];
        $product->product_title = $request['product_title'];
        $product->product_description = $request['product_description'];
        $product->product_price = $request['product_price'];
        $product->save();
        $res = Product_image::create_new($product->id,$request);
        return $res; 
    }


    public function Images()
    {
        return $this->hasMany('App\Product_image');
    }

    protected $hidden = [
        'seller_id', 'created_at', 'updated_at'
    ];
}