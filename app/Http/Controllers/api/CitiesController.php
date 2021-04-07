<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Citie;

class CitiesController extends Controller
{
    public function getCities(){
        $cities = Citie::all();
        return response()->json($cities, 200);
    }
}
