<?php

namespace App\Http\Controllers;

use App\Models\Culinary;
use App\Models\Destination;
use App\Models\DestinationPrice;
use App\Models\Homestay;
use App\Models\HomestayPhoto;
use App\Models\NearbyPlace;
use App\Models\Photo;
use App\Models\PopularPlace;
use App\Models\Promo;
use App\Models\Souvenir;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{



    public function indexSouvenir(){
        $data = Souvenir::all();
        return view('souvenir', ['sou'=>$data]);
    }
    public function indexPromo(){
        $data = Promo::all();
        return view('promo', ['pro'=>$data]);
    }
    public function indexDestination(){
        $data = Destination::all();
        return view('destination', ['des'=>$data]);
    }
    public function indexDestinationDetail($id){
        $data = Destination::find($id);
        return view('destinationDetail', ['des'=>$data]);
    }

    public function indexAdminHomestay(){
        $data = Homestay::all();
        return view('admin.tableHomestay', ['productHomestay'=>$data]);
    }
    public function indexAdminEditHomestay($id){
        $data = Homestay::find($id);
        $pho = HomestayPhoto::where('homestay_id', $id)->orderBy('index', 'asc')->get();
        $np = NearbyPlace::where('homestay_id', $id)->get();
        $pp = PopularPlace::where('homestay_id', $id)->get();

        return view('admin.editHomestay', ['data' => $data, 'pho'=> $pho, 'np' => $np, 'pp' => $pp]);
    }

    public function indexAdminCulinary(){
        $data = Culinary::all();
        return view('admin.tableCulinary', ['foodCulinary'=>$data]);
    }
    public function indexAdminEditCulinary($id){
        $data = Culinary::find($id);
        return view('admin.editCulinary', ['data'=>$data]);
    }

    public function indexAdminDestination(){
        $data = Destination::all();
        return view('admin.tableDestination', ['tes'=>$data]);
    }
    public function indexAdminEditDestination($id){
        $data = Destination::find($id);
        $price = DestinationPrice::where('destination_id', $id)->orderBy('min_person', 'asc')->get();
        return view('admin.editDestination', ['data'=> $data, 'price' => $price ]);
    }

    public function indexAdminSouvenir(){
        $data = Souvenir::all();
        return view('admin.tableSouvenir', ['tes'=>$data]);
    }
    public function indexAdminEditSouvenir($id){
        $data = Souvenir::find($id);
        return view('admin.editSouvenir', ['data'=>$data]);
    }

    public function indexAdminPromo(){
        $data = Promo::all();
        return view('admin.tablePromo', ['tes'=>$data]);
    }
    public function indexAdminEditPromo($id){
        $data = Promo::find($id);
        return view('admin.editPromo', ['data'=>$data]);
    }

}
