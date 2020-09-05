<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public static function create_new($request)
    {
        $shop = new self();
        $shop->shop_owner_id = auth()->user()->shopOwner->id;
        $shop->company = $request['company'];
        $shop->shop_type = $request['shop_type'];
        $shop->shop_description = $request['shop_description'];
        $shop->shop_url = $request['shop_url'];
        $shop->save();
    }

    public static function updateShop($request, $id)
    {
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        if ($shops) {
            foreach ($shops as $shop) {
                if ($shop->id == $id) {
                    $shop->company = $request['company'];
                    $shop->shop_type = $request['shop_type'];
                    $shop->shop_description = $request['shop_description'];
                    $shop->shop_url = $request['shop_url'];
                    $shop->save();
                    return true;
                }
            }
        }
        return false;
    }

    public function shopProducts()
    {
        return $this->hasMany('App\Shop_product');
    }

    public function landingPage()
    {
        return $this->hasMany('App\Landing_page');
    }
}