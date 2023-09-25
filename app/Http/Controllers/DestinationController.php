<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function destinationPage()
    {
        return view('destination', [
            'destinations' => Destination::limit(20)->get()
        ]);
    }

    public function destinationDetailPage($id)
    {
        return view('destinationDetail', [
            'destination' => Destination::findOrFail($id)
        ]);
    }
}
