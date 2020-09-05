<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        return response()->json($shops, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Shop::create_new($request);
        return response()->json('created', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        foreach ($shops as $shop) {
            if ($shop->id == $id) {
                return response()->json($shop, 200);
            }
        }

        return response("shop not found", 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Shop::updateShop($request, $id)) {
            return response()->json('updated', 200);
        }
        return response()->json('shop not found', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopOwner = auth()->user()->shopOwner;
        $shops = $shopOwner->shops;
        foreach ($shops as $shop) {
            if ($shop->id == $id) {
                $shop->delete();
                return "success";
            }
        }
        return "not found";
    }
}