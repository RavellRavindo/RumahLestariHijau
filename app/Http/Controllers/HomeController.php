<?php

namespace App\Http\Controllers;

use App\Models\Culinary;
use App\Models\Destination;
use App\Models\Promo;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'promos' => Promo::limit(10)->get(),
            'culinary' => Culinary::first(),
            'destination' => Destination::first()
        ]);
    }
}
