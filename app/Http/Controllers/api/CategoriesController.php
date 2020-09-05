<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categorie;

class CategoriesController extends Controller
{
    public function getCategories(){
        $categories = Categorie::all();
        return response()->json($categories, 200);
    }

    public function getCategoryProducts($categoryUrl)
    {
        $category =  Categorie::all()->where('categorie_url', '=', $categoryUrl)->first();
        $products = $category->categoryProducts;

        if ($products) {
            foreach ($products as $product) {
                $product->Images;
            }
            return response()->json($products, 200);
        } else {
            return response()->json("No Products Found", 200);
        }
    }
}
