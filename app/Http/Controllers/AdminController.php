<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Culinary;
use App\Models\Destination;
use App\Models\Souvenir;
use App\Models\Promo;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function homePage()
    {
        return view('admin.home');
    }

    public function tablePage($table)
    {
        switch ($table) {
        case 'homestay':    return view('admin.tableHomestay',    ['homestays'    => Homestay::paginate(10)]);
        case 'culinary':    return view('admin.tableCulinary',    ['culinaries'   => Culinary::paginate(10)]);
        case 'destination': return view('admin.tableDestination', ['destinations' => Destination::paginate(10)]);
        case 'souvenir':    return view('admin.tableSouvenir',    ['souvenirs'    => Souvenir::paginate(10)]);
        case 'promo':       return view('admin.tablePromo',       ['promos'       => Promo::paginate(10)]);
        default:            return response([], 404);
        }
    }

    public function addTablePage($table)
    {
        switch ($table) {
        case 'homestay':    return view('admin.createHomestay');
        case 'culinary':    return view('admin.createCulinary');
        case 'destination': return view('admin.createDestination');
        case 'souvenir':    return view('admin.createSouvenir');
        case 'promo':       return view('admin.createPromo');
        default:            return response([], 404);
        }
    }

    public function editTablePage($table, $id)
    {
        switch ($table) {
        case 'homestay':    return view('admin.editHomestay',    ['homestay'    => Homestay::findOrFail($id)]);
        case 'culinary':    return view('admin.editCulinary',    ['culinary'    => Culinary::findOrFail($id)]);
        case 'destination': return view('admin.editDestination', ['destination' => Destination::findOrFail($id)]);
        case 'souvenir':    return view('admin.editSouvenir',    ['souvenir'    => Souvenir::findOrFail($id)]);
        case 'promo':       return view('admin.editPromo',       ['promo'       => Promo::findOrFail($id)]);
        default:            return response([], 404);
        }
    }

    public function addTable($table)
    {
        switch ($table) {
        case 'homestay':    return view('admin.createHomestay');
        case 'culinary':    return view('admin.createCulinary');
        case 'destination': return view('admin.createDestination');
        case 'souvenir':    return view('admin.createSouvenir');
        case 'promo':       return view('admin.createPromo');
        default:            return response([], 404);
        }
    }

    public function editTable($table, $id)
    {
        switch ($table) {
        case 'homestay':    return $this->editHomestay($id);
        case 'culinary':    return $this->editCulinary($id);
        case 'destination': return $this->editDestination($id);
        case 'souvenir':    return $this->editSouvenir($id);
        case 'promo':       return $this->editPromo($id);
        default:            return response([], 404);
        }
    }

    public function deleteTable($table, $id)
    {
        switch ($table) {
        case 'homestay':    return $this->deleteHomestay($id);
        case 'culinary':    return $this->deleteCulinary($id);
        case 'destination': return $this->deleteDestination($id);
        case 'souvenir':    return $this->deleteSouvenir($id);
        case 'promo':       return $this->deletePromo($id);
        default:            return response([], 404);
        }
    }

    private function saveImage($image)
    {
        $savefile = Str::orderedUuid().'.'.$image->getClientOriginalExtension();
        Storage::putFileAs('assets/', $image, $savefile);
        return $savefile;
    }

    private function deleteImage($imagePath)
    {
        Storage::delete($imagePath);
    }

    public function addHomestay()
    {
        $attr = request()->validate([
            'name'      => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'location'  => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'host'      => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'address'   => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'rating'    => 'required',
            'like'      => 'required',
            'price'     => 'required',
            'guest'     => 'required',
            'bedroom'   => 'required',
            'bed'       => 'required',
            'bath'      => 'required',
            'thumbnail' => 'required',
            'images'    => 'required'
        ]);

        $thumb  = request()->file('thumbnail');
        $images = request()->file('images');

        $hs                 = new Homestay();
        $hs->name           = $attr->name;
        $hs->location       = $attr->location;
        $hs->host           = $attr->host;
        $hs->address        = $attr->address;
        $hs->rating         = $attr->rating;
        $hs->like           = $attr->like;
        $hs->price          = $attr->price;
        $hs->guest          = $attr->guest;
        $hs->bedroom        = $attr->bedroom;
        $hs->bed            = $attr->bed;
        $hs->bath           = $attr->bath;

        $hs->has_wifi       = $attr->has_wifi;
        $hs->has_parking    = $attr->has_parking;
        $hs->has_restaurant = $attr->has_restaurant;
        $hs->has_ac         = $attr->has_ac;
        $hs->save();

        $photo              = new HomestayPhoto();
        $photo->homestay_id = $hs->id;
        $photo->index       = 0;
        $photo->path        = $this->saveImage($thumb);
        $photo->save();

        foreach ($images as $key => $img) {
            $photo              = new HomestayPhoto();
            $photo->homestay_id = $hs->id;
            $photo->index       = $key + 1;
            $photo->path        = $this->saveImage($img);
            $photo->save();
        }

        return redirect('/admin/homestay/' . $hs->id);
    }

    public function editHomestay($id)
    {
        $hs = Homestay::findOrFail($id);

        $attr = request()->validate([
            'name'      => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'location'  => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'host'      => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'address'   => 'required|regex:/^[a-zA-Z \.,]+$/u|max:255',
            'rating'    => 'required',
            'like'      => 'required',
            'price'     => 'required',
            'guest'     => 'required',
            'bedroom'   => 'required',
            'bed'       => 'required',
            'bath'      => 'required',
            'thumbnail' => 'required',
            'images'    => 'required'
        ]);

        $thumb  = request()->file('thumbnail');
        $images = request()->file('images');

        $hs->name           = $attr->name;
        $hs->location       = $attr->location;
        $hs->host           = $attr->host;
        $hs->address        = $attr->address;
        $hs->rating         = $attr->rating;
        $hs->like           = $attr->like;
        $hs->price          = $attr->price;
        $hs->guest          = $attr->guest;
        $hs->bedroom        = $attr->bedroom;
        $hs->bed            = $attr->bed;
        $hs->bath           = $attr->bath;

        $hs->has_wifi       = $attr->has_wifi;
        $hs->has_parking    = $attr->has_parking;
        $hs->has_restaurant = $attr->has_restaurant;
        $hs->has_ac         = $attr->has_ac;
        $hs->save();

        foreach ($hs->homestay_photo as $photo) {
            $this->deleteImage($photo->path);
        }
        $hs->homestay_photo->each->delete();

        $photo              = new HomestayPhoto();
        $photo->homestay_id = $hs->id;
        $photo->index       = 0;
        $photo->path        = $this->saveImage($thumb);
        $photo->save();

        foreach ($images as $key => $img) {
            $photo              = new HomestayPhoto();
            $photo->homestay_id = $hs->id;
            $photo->index       = $key + 1;
            $photo->path        = $this->saveImage($img);
            $photo->save();
        }

        return redirect('/admin/homestay/' . $hs->id);
    }

    public function deleteHomestay($id)
    {
        $hs = Homestay::find($id);

        $hs->nearby_place->each->delete();
        $hs->popular_place->each->delete();

        foreach ($hs->homestay_photo as $photo) {
            $this->deleteImage($photo->path);
        }

        $hs->homestay_photo->each->delete();
        $hs->comment_list->each->delete();

        $hs->delete();

        return redirect()->back()->with('success', 'Homestay deleted successfully');
    }

    public function addDestination()
    {
        $attr = request()->validate([
            'name' => 'required|min:7|max:255',
            'description'=>'required|min:10|max:600',
            'rundown' => 'required',
            'address' => 'required|min:3|max:255',
            'image' => 'required|image',
            'price' => 'required'
        ]);

        $savedImage = $this->saveImage($attr->file('image'));

        $data = new Destination();
        $data->name = $attr->name;
        $data->description = $attr->description;
        $data->rundown = $attr->rundown;
        $data->address = $attr->address;
        $data->price = $attr->price;
        $data->photo = $savedImage;
        $data->save();

        // $dprice = new DestinationPrice();
        // $dprice->destination_id = $data->id;
        // $dprice->min_person = $request->minpnew;
        // $dprice->max_person = $request->maxpnew;
        // $dprice->price = $request->pricenew;
        // $dprice->save();

        return redirect('/admin/destination/' . $data->id);
    }

    public function editDestination($id)
    {
        $attr = request()->validate([
            'name' => 'required|min:7|max:255',
            'description'=>'required|min:10|max:600',
            'rundown' => 'required',
            'address' => 'required|min:3|max:255',
            'image' => 'required|image',
            'price' => 'required'
        ]);

        $data = Destination::find($id);
        $savedImage = $this->saveImage($attr->file('image'));

        Storage::delete($data->photo);

        $data->name = $attr->name;
        $data->description = $attr->description;
        $data->rundown = $attr->rundown;
        $data->address = $attr->address;
        $data->price = $attr->price;
        $data->photo = $savedImage;
        $data->save();

        return redirect('/admin/destination/' . $data->id);
    }

    public function deleteDestination($id)
    {
        $data = Destination::find($id);
        Storage::delete($data->photo);
        $data->delete();

        return redirect()->back()->with('success', 'Destination deleted successfully');
    }

    public function addCulinary()
    {
        $attr = request()->validate([
            'name' => 'required|min:7|max:255',
            'description'=>'required|min:10|max:600',
            'like' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $savedImage = $this->saveImage($attr->file('image'));

        $data = new Culinary();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->like = $request->like;
        $data->price = $request->price;
        $data->photo = $savedImage;
        $data->save();

        return redirect('/admin/culinary/' . $data->id);
    }

    public function editCulinary($id)
    {
        $attr = request()->validate([
            'name' => 'required|min:7|max:255',
            'description'=>'required|min:10|max:600',
            'like' => 'required',
            'image' => 'image',
        ]);

        $data = Culinary::find($id);
        $savedImage = $this->saveImage($attr->file('image'));

        Storage::delete($data->photo);

        $data->name = $request->name;
        $data->description = $request->description;
        $data->like = $request->like;
        $data->price = $request->price;
        $data->photo = $savedImage;
        $data->save();

        return redirect('/admin/culinary/' . $data->id);
    }

    // Photo culinary tiba" ada banyak (:
    public function deleteCulinary(Request $request, $id){
        $data = Culinary::find($id);
        foreach ($data->photo as $key) {
            Storage::delete($key->path);
        }
        $data->photo->each->delete();
        $data->comment_list->each->delete();
        $data->delete();

        return redirect()->back()->with('success', 'Culinary deleted successfully');
    }


    public function addSouvenir(Request $request) {
        $file = $request->file('image');

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required',
            'price'=>'required',
        ]);
        // dd($request);
        $data = new Souvenir();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;

        if($file!=null){
            $request->validate([
                'image' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($data->name, 10);
            $sou_path = $temp.'_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('souvenir_img/', $file, $sou_path);

            $sou_path = 'souvenir_img/'.$sou_path;
            $data->photo = $sou_path;
        }

        $data->save();
        return redirect('/tableSouvenir');
    }
    public function editSouvenir(Request $request, $id) {
        $file = $request->file('image');

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ]);
        // dd($request);
        $data = Souvenir::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->price = $request->price;

        if($file!=null){
            $request->validate([
                'image' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($data->name, 10);
            $sou_path = $temp.'_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::delete($data->photo);
            Storage::putFileAs('souvenir_img/', $file, $sou_path);

            $sou_path = 'souvenir_img/'.$sou_path;
            $data->photo = $sou_path;
        }

        $data->save();
        return redirect('/tableSouvenir');
    }
    public function deleteSouvenir(Request $request, $id){
        $data = Souvenir::find($id);
        Storage::delete($data->photo);
        $data->delete();
        return redirect()->back()->with('success', 'Souvenir deleted successfully');
    }

    public function addPromo(Request $request) {
        $file = $request->file('image');

        $request->validate([
            'name'=>'required',
            'image'=>'required',
        ]);
        // dd($request);
        $data = new Promo();
        $data->name = $request->name;

        if($file!=null){
            $request->validate([
                'image' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($data->name, 10);
            $pr_path = $temp.'_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('promo_img/', $file, $pr_path);

            $pr_path = 'promo_img/'.$pr_path;
            $data->photo = $pr_path;
        }

        $data->save();
        return redirect('/tablePromo');
    }
    public function editPromo(Request $request, $id) {
        $file = $request->file('image');

        $request->validate([
            'name'=>'required',
        ]);
        // dd($request);
        $data = Promo::find($id);
        $data->name = $request->name;

        if($file!=null){
            $request->validate([
                'image' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($data->name, 10);
            $pr_path = $temp.'_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::delete($data->photo);
            Storage::putFileAs('promo_img', $file, $pr_path);

            $pr_path = 'promo_img/'.$pr_path;
            $data->photo = $pr_path;
        }

        $data->save();
        return redirect('/tablePromo');
    }
    public function deletePromo(Request $request, $id){
        $data = Promo::find($id);
        Storage::delete($data->photo);
        $data->delete();
        return redirect()->back()->with('success', 'Promo deleted successfully');
    }

}
