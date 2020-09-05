<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landing_page extends Model
{

    static public function create_new($request)
    {
        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {
            if ($shop->id == $request['shop_id']) {
                $landingPage = new self();
                $landingPage->shop_id = $request['shop_id'];
                $landingPage->page_title = $request['page_title'];
                $landingPage->page_url = $request['page_url'];
                $landingPage->save();
                return true;
            }
        }
        return false;
    }

    static public function updateLPage($request, $id)
    {
        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {
            $landingPages = $shop->landingPage;
            foreach ($landingPages as $landingPage) {
                if ($landingPage->id == $id) {
                    $landingPage->shop_id = $request['shop_id'];
                    $landingPage->page_title = $request['page_title'];
                    $landingPage->page_url = $request['page_url'];
                    $landingPage->save();
                    return true;
                }
            }
        }

        return false;
    }

    static public function deletePage($id)
    {

        $owner = auth()->user()->shopOwner;
        $shops = $owner->shops;
        foreach ($shops as $shop) {

            $landingPages = $shop->landingPage;
            foreach ($landingPages as $landingPage) {
                if ($landingPage->id == $id) {
                    $landingPage->delete();
                    return true;
                }
            }
        }
        return false;
    }
}