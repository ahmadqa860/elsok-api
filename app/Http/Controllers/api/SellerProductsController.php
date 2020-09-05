<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Seller;
use Illuminate\Http\Request;

class SellerProductsController extends Controller
{

    public function index()
    {
        $seller = auth()->user()->seller;

        if ($products = Seller::find($seller->id)->sellerProducts) {
            foreach ($products as $product) {
                $product->Images;
            }
            return response()->json($products, 200);
        }
        return response()->json('no products found');
    }

    /* public function store(ProductRequest $request) */
    public function store(Request $request)
    {
         $res = Product::create_new($request);
         return $res;   
    }

    public function show($id)
    {
        $seller = auth()->user()->seller;
        if ($products = Seller::find($seller->id)->sellerProducts) {
            foreach ($products as $product) {
                if ($product->id == $id) {
                    $product->Images;
                    return response()->json($product, 200);
                }
            }
        }

        return response()->json("product not found", 200);
    }

    public function edit($id)
    {
        $seller = auth()->user()->seller;
        if ($products = Seller::find($seller->id)->sellerProducts) {
            foreach ($products as $product) {
                if ($product->id == $id) {
                    $product->Images;
                    return response()->json($product, 200);
                }
            }
        }
        return response()->json("product not found", 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $seller = auth()->user()->seller;
        if ($sellerProducts = Seller::find($seller->id)->sellerProducts) {
            foreach ($sellerProducts as $product) {
                if ($product->id == $id) {
                    $product->category_id = $request['category_id'];
                    $product->product_title = $request['product_title'];
                    $product->product_description = $request['product_description'];
                    $product->product_price = $request['product_price'];
                    $product->product_url = $request['product_url'];
                    $product->save();
                    return response()->json("Updated", 200);
                }
            }
        }
        return response()->json("product not found", 200);
    }

    public function destroy($id)
    {
        $seller = auth()->user()->seller;
        if ($sellerProducts = Seller::find($seller->id)->sellerProducts) {
            foreach ($sellerProducts as $product) {
                if ($product->id == $id) {
                    $product->delete();
                    return response()->json("Deleted", 200);
                }
            }
        }
        return response()->json("product not found", 200);
    }
}