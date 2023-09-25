<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;

class SouvenirController extends Controller
{
    public function souvenirPage()
    {
        return view('souvenir', [
            'souvenirs' => Souvenir::limit(20)->get()
        ]);
    }
}
