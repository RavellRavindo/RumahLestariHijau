<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function promoPage()
    {
        return view('promo', [
            'promos' => Promo::limit(15)->get()
        ]);
    }
}
