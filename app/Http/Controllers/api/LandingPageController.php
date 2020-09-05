<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Landing_page;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $landingPages = new Landing_page;
        $owner = auth()->user()->shopOwner;
        if ($shops = $owner->shops) {
            foreach ($shops as $shop) {
                $landingPages = $shop->landingPage;
            }

            if ($landingPages) {
                return response()->json($landingPages, 200);
            }
        }
        return response()->json('landing page not found', 200);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if (Landing_page::create_new($request)) {
            return response()->json("created", 200);
        }

        return response()->json("Shop not found", 200);
    }


    public function show($id)
    {
        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {
            $landingPages = $shop->landingPage;
            foreach ($landingPages as $landingPage) {
                if ($landingPage->id == $id) {
                    return $landingPage;
                }
            }
        }
        return 'landing page not found';
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        if (Landing_page::updateLPage($request, $id)) {
            return response()->json('updated', 200);
        }
        return response()->json('error', 200);
    }

    public function destroy($id)
    {
        if (Landing_page::deletePage($id)) {
            return response()->json('deleted', 200);
        }

        return response()->json('error', 200);
    }
}