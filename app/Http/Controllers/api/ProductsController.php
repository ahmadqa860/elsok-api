<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Categorie;
use App\Product;
use App\Seller;
use App\User;
use App\Profile;

class ProductsController extends Controller
{
    public function getProducts()
    {
        $products =  Product::all();
        foreach ($products as $product) {
            $product->Images;
        }
        return response()->json($products, 200);
    }

    public function getProductDetails($id)
    {
        $product =  Product::find($id);
        if ($product) {
            $product->Images;
            return response()->json($product, 200);
        } else {
            return response()->json("product not found", 200);
        }
    }

    public function getProductContactDetails($id){
        $product = Product::find($id);
        $seller = Seller::find($product->seller_id);
        $user = User::find($seller->user_id);
        $profile = DB::table('profiles')->where('user_id','=',$user->id)->first();
        return response()->json($profile,200);
    }
}