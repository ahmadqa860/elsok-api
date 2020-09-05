<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_product extends Model
{

    public static function create_new($request)
    {
        $shopProduct = new self();
        $shopProduct->shop_id = $request['shop_id'];
        $shopProduct->categorie_id = $request['categorie_id'];
        $shopProduct->product_price = $request['product_price'];
        $shopProduct->product_title = $request['product_title'];
        $shopProduct->product_description = $request['product_description'];
        $shopProduct->save();
    }

    public static function updateProduct($request, $id)
    {
        $products = new Shop_product;
        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {
            $products = $shop->shopProducts;
            foreach ($products as $product) {
                if ($product->id == $id) {
                    $product->product_price = $request['product_price'];
                    $product->product_title = $request['product_title'];
                    $product->product_description = $request['product_discription'];
                    $product->save();
                    return true;
                }
            }
        }

        return false;
    }

/*      public static function delete($id)
    {
        $products = new Shop_product;
        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {
            $products = $shop->shopProducts;
            foreach ($products as $product) {
                if ($product->id == $id) {
                    $product->delete();
                    return true;
                }
            }
        }

        return false;
    }  */


    public function productImages()
    {
        return $this->hasMany('App\Shop_product_image');
    }
}