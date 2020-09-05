<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Shop_product;
use Illuminate\Http\Request;

class ShopProductsController extends Controller
{

    public function index()
    {
        
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        foreach ($shops as $shop) {
                $shop->shopProducts;                
        }
        
        return response()->json($shops,200);
        return response()->json('no products found', 200);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Shop_product::create_new($request);
    }


    public function show($id)
    {
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        foreach ($shops as $shop) {
                $shopProducts = $shop->shopProducts;
                foreach ($shopProducts as $shopProduct) {
                    if($shopProduct->id == $id){
                        $shopProduct->productImages;
                        return $shopProduct;
                    }
                }
                return $shopProducts;
        }
        return response()->json('no products found', 200);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

        if (Shop_product::updateProduct($request, $id)) {
            return response()->json('updated', 200);
        }

        return response()->json('failed', 200);
    }


    public function destroy($id)
    {
         if (Shop_product::delete($id)) {
            return response('deleted', 200);
        }

        return response('failed', 200); 
    }
}