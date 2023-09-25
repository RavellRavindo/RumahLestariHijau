<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;
use Illuminate\Http\Request;

class SouvenirController extends Controller
{
    public function souvenirPage()
    {
        return view('souvenir', [
            'souvenirs' => Souvenir::limit(20)->get()
        );
    }
}
