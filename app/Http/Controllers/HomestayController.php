<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomestayController extends Controller
{
    public function homestayPage()
    {
        $attr = request()->validate([
            'q' => 'regex:/^[a-zA-Z \.,]+$/u|max:255',
            'sort' => 'in:price,rating',
            'filter' => 'regex:/^[a-z\,]+$/u|max:32',
            'asc' => 'in:false,true'
        ]);

        $q      = request()->get('q');
        $sort   = request()->get('sort');
        $filter = request()->get('filter');
        $asc    = request()->get('asc');

        $query = Homestay::selectRaw('*');

        if (!empty($filter)) {
            $queryFilter = [];

            foreach (explode(',', $filter) as $f) {
                if (in_array($f, ['wifi', 'parking', 'ac', 'restaurant'])) {
                    array_push($queryFilter, ['has_'.$f, '=', true]);
                }
            }

            $query = $query->where($queryFilter);
        }

        if (!empty($q)) {
            $query = $query->search($q);
        }

        if (!empty($sort)) {
            $query = $query->orderBy($sort, $asc == 'true' ? 'asc' : 'desc');
        }

        return view('homestay', [
            'homestays' => $query->paginate(10)
        ]);
    }

    public function addHomestay(Request $request){
        $file = $request->file('thumbnail');
        $file1 = $request->file('upload');
        $file2 = $request->file('upload2');
        $file3 = $request->file('upload3');
        $file4 = $request->file('upload4');
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'host' => 'required',
            'address' => 'required',
            'rating' => 'required',
            'like'=>'required',
            'price' => 'required',
            'guest' => 'required',
            'bedroom' => 'required',
            'bed' => 'required',
            'bath' => 'required',
            'thumbnail' => 'required',
        ]);

        if($request->nearbyplace1!=null || $request->nearbydistance1!=null){
            $request->validate([
                'nearbyplace1' => 'required',
                'nearbydistance1' => 'required',
            ]);
        }
        if($request->nearbyplace2!=null || $request->nearbydistance2!=null){
            $request->validate([
                'nearbyplace2' => 'required',
                'nearbydistance2' => 'required',
            ]);
        }
        if($request->nearbyplace3!=null || $request->nearbydistance3!=null){
            $request->validate([
                'nearbyplace3' => 'required',
                'nearbydistance3' => 'required',
            ]);
        }
        if($request->nearbyplace4!=null || $request->nearbydistance4!=null){
            $request->validate([
                'nearbyplace4' => 'required',
                'nearbydistance4' => 'required',
            ]);
        }
        if($request->popularplace1!=null || $request->populardistance1!=null){
            $request->validate([
                'popularplace1' => 'required',
                'populardistance1' => 'required',
            ]);
        }
        if($request->popularplace2!=null || $request->populardistance2!=null){
            $request->validate([
                'popularplace2' => 'required',
                'populardistance2' => 'required',
            ]);
        }
        if($request->popularplace3!=null || $request->populardistance3!=null){
            $request->validate([
                'popularplace3' => 'required',
                'populardistance3' => 'required',
            ]);
        }
        if($request->popularplace4!=null || $request->populardistance4!=null){
            $request->validate([
                'popularplace4' => 'required',
                'populardistance4' => 'required',
            ]);
        }

        $hs = new Homestay();
        $hs->name = $request->name;
        $hs->location = $request->location;
        $hs->host = $request->host;
        $hs->address = $request->address;
        $hs->rating = $request->rating;
        $hs->like = $request->like;
        $hs->price = $request->price;
        $hs->guest = $request->guest;
        $hs->bedroom = $request->bedroom;
        $hs->bed = $request->bed;
        $hs->bath = $request->bath;

        if($request->wifi == 1){
            $hs->wifi = 1;
        }else{
            $hs->wifi = 0;
        }
        if($request->parking == 1){
            $hs->parking = 1;
        }else{
            $hs->parking = 0;
        }
        if($request->restaurant == 1){
            $hs->restaurant = 1;
        }else{
            $hs->restaurant = 0;
        }
        if($request->ac == 1){
            $hs->ac = 1;
        }else{
            $hs->ac = 0;
        }
        $hs->save();

        if($file!=null){
            $request->validate([
                'thumbnail' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $thumb_path = 'thumb_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file, $thumb_path);
            $thumb_path = 'homestay_img/'.$temp.'/'.$thumb_path;

            $thumb = new HomestayPhoto();
            $thumb->homestay_id = $hs->id;
            $thumb->index = 1;
            $thumb->path = $thumb_path;
            $thumb->save();
        }
        if($file1!=null){
            $request->validate([
                'upload' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img1_path = 'img1_'.$dt.'.'.$file1->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file1, $img1_path);
            $img1_path = 'homestay_img/'.$temp.'/'.$img1_path;

            $pho1 = new HomestayPhoto();
            $pho1->homestay_id = $hs->id;
            $pho1->index = 2;
            $pho1->path = $img1_path;
            $pho1->save();
        }
        if($file2!=null){
            $request->validate([
                'upload2' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img2_path = 'img2_'.$dt.'.'.$file2->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file2, $img2_path);
            $img2_path = 'homestay_img/'.$temp.'/'.$img2_path;

            $pho2 = new HomestayPhoto();
            $pho2->homestay_id = $hs->id;
            $pho2->index = 3;
            $pho2->path = $img2_path;
            $pho2->save();
        }
        if($file3!=null){
            $request->validate([
                'upload3' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img3_path = 'img3_'.$dt.'.'.$file1->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file3, $img3_path);
            $img3_path = 'homestay_img/'.$temp.'/'.$img3_path;

            $pho3 = new HomestayPhoto();
            $pho3->homestay_id = $hs->id;
            $pho3->index = 4;
            $pho3->path = $img3_path;
            $pho3->save();
        }
        if($file4!=null){
            $request->validate([
                'upload4' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img4_path = 'img4_'.$dt.'.'.$file4->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file4, $img4_path);
            $img4_path = 'homestay_img/'.$temp.'/'.$img4_path;

            $pho4 = new HomestayPhoto();
            $pho4->homestay_id = $hs->id;
            $pho4->index = 5;
            $pho4->path = $img4_path;
            $pho4->save();
        }

        if($request->nearbyplace1!=null){
            $np1 = new NearbyPlace();
            $np1->homestay_id = $hs->id;
            $np1->name = $request->nearbyplace1;
            $np1->distance = $request->nearbydistance1;
            $np1->save();
        }
        if($request->nearbyplace2!=null){
            $np2 = new NearbyPlace();
            $np2->homestay_id = $hs->id;
            $np2->name = $request->nearbyplace2;
            $np2->distance = $request->nearbydistance2;
            $np2->save();
        }
        if($request->nearbyplace3!=null){
            $np3 = new NearbyPlace();
            $np3->homestay_id = $hs->id;
            $np3->name = $request->nearbyplace3;
            $np3->distance = $request->nearbydistance3;
            $np3->save();
        }
        if($request->nearbyplace4!=null){
            $np4 = new NearbyPlace();
            $np4->homestay_id = $hs->id;
            $np4->name = $request->nearbyplace4;
            $np4->distance = $request->nearbydistance4;
            $np4->save();
        }

        if($request->popularplace1!=null){
            $pp1 = new PopularPlace();
            $pp1->homestay_id = $hs->id;
            $pp1->name = $request->popularplace1;
            $pp1->distance = $request->populardistance1;
            $pp1->save();
        }
        if($request->popularplace2!=null){
            $pp2 = new PopularPlace();
            $pp2->homestay_id = $hs->id;
            $pp2->name = $request->popularplace2;
            $pp2->distance = $request->populardistance2;
            $pp2->save();
        }
        if($request->popularplace3!=null){
            $pp3 = new PopularPlace();
            $pp3->homestay_id = $hs->id;
            $pp3->name = $request->popularplace3;
            $pp3->distance = $request->populardistance3;
            $pp3->save();
        }
        if($request->popularplace4!=null){
            $pp4 = new PopularPlace();
            $pp4->homestay_id = $hs->id;
            $pp4->name = $request->popularplace4;
            $pp4->distance = $request->populardistance4;
            $pp4->save();
        }

        return redirect('/tableHomestay');
    }
    public function editHomestay(Request $request, $id){
        $hs = Homestay::find($id);
        $file = $request->file('thumbnail');
        $file1 = $request->file('upload');
        $file2 = $request->file('upload2');
        $file3 = $request->file('upload3');
        $file4 = $request->file('upload4');
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'host' => 'required',
            'address' => 'required',
            'rating' => 'required',
            'like'=>'required',
            'price' => 'required',
            'guest' => 'required',
            'bedroom' => 'required',
            'bed' => 'required',
            'bath' => 'required',
            'thumbnail' => 'required',
        ]);

        if($request->nearbyplace1!=null || $request->nearbydistance1!=null){
            $request->validate([
                'nearbyplace1' => 'required',
                'nearbydistance1' => 'required',
            ]);
        }
        if($request->nearbyplace2!=null || $request->nearbydistance2!=null){
            $request->validate([
                'nearbyplace2' => 'required',
                'nearbydistance2' => 'required',
            ]);
        }
        if($request->nearbyplace3!=null || $request->nearbydistance3!=null){
            $request->validate([
                'nearbyplace3' => 'required',
                'nearbydistance3' => 'required',
            ]);
        }
        if($request->nearbyplace4!=null || $request->nearbydistance4!=null){
            $request->validate([
                'nearbyplace4' => 'required',
                'nearbydistance4' => 'required',
            ]);
        }
        if($request->popularplace1!=null || $request->populardistance1!=null){
            $request->validate([
                'popularplace1' => 'required',
                'populardistance1' => 'required',
            ]);
        }
        if($request->popularplace2!=null || $request->populardistance2!=null){
            $request->validate([
                'popularplace2' => 'required',
                'populardistance2' => 'required',
            ]);
        }
        if($request->popularplace3!=null || $request->populardistance3!=null){
            $request->validate([
                'popularplace3' => 'required',
                'populardistance3' => 'required',
            ]);
        }
        if($request->popularplace4!=null || $request->populardistance4!=null){
            $request->validate([
                'popularplace4' => 'required',
                'populardistance4' => 'required',
            ]);
        }

        if ($request->name != $hs->name){
            if ($file1 == null && $hs->homestay_photo[1]->path != null) {
                $fileAddress = public_path('storage/'. $hs->homestay_photo[1]->path);
                $file1 = new UploadedFile($fileAddress, $hs->homestay_photo[1]->path);
                $request->files->set('upload1', $file1);
            }
            if ($file2 == null && $hs->homestay_photo[2]->path != null) {
                $fileAddress = public_path('storage/'. $hs->homestay_photo[2]->path);
                $file2 = new UploadedFile($fileAddress, $hs->homestay_photo[2]->path);
                $request->files->set('upload2', $file2);
            }
            if ($file3 == null && $hs->homestay_photo[3]->path != null) {
                $fileAddress = public_path('storage/'. $hs->homestay_photo[3]->path);
                $file3 = new UploadedFile($fileAddress, $hs->homestay_photo[3]->path);
                $request->files->set('upload3', $file3);
            }
            if ($file4 == null && $hs->homestay_photo[4]->path != null) {
                $fileAddress = public_path('storage/'. $hs->homestay_photo[4]->path);
                $file4 = new UploadedFile($fileAddress, $hs->homestay_photo[4]->path);
                $request->files->set('upload4', $file4);
            }
        }

        $oldhs_name = $hs->name;

        $hs->name = $request->name;
        $hs->location = $request->location;
        $hs->host = $request->host;
        $hs->address = $request->address;
        $hs->rating = $request->rating;
        $hs->like = $request->like;
        $hs->price = $request->price;
        $hs->guest = $request->guest;
        $hs->bedroom = $request->bedroom;
        $hs->bed = $request->bed;
        $hs->bath = $request->bath;

        if($request->wifi == 1){
            $hs->wifi = 1;
        }else{
            $hs->wifi = 0;
        }
        if($request->parking == 1){
            $hs->parking = 1;
        }else{
            $hs->parking = 0;
        }
        if($request->restaurant == 1){
            $hs->restaurant = 1;
        }else{
            $hs->restaurant = 0;
        }
        if($request->ac == 1){
            $hs->ac = 1;
        }else{
            $hs->ac = 0;
        }

        $hs->save();

        $count = count($hs->homestay_photo);

        if($file!=null){
            $request->validate([
                'thumbnail' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $thumb_path = 'thumb_'.$dt.'.'.$file->getClientOriginalExtension();
            Storage::delete($hs->homestay_photo[0]->path);
            Storage::putFileAs('homestay_img/'.$temp.'/', $file, $thumb_path);
            $thumb_path = 'homestay_img/'.$temp.'/'.$thumb_path;

            $hs->homestay_photo[0]->homestay_id = $hs->id;
            $hs->homestay_photo[0]->index = 1;
            $hs->homestay_photo[0]->path = $thumb_path;
            $hs->homestay_photo[0]->save();
        }

        if($file1!=null){
            $request->validate([
                'upload1' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img1_path = 'img1_'.$dt.'.'.$file1->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file1, $img1_path);
            $img1_path = 'homestay_img/'.$temp.'/'.$img1_path;

            if($count>=2){
                Storage::delete($hs->homestay_photo[1]->path);
                $hs->homestay_photo[1]->homestay_id = $hs->id;
                $hs->homestay_photo[1]->index = 2;
                $hs->homestay_photo[1]->path = $img1_path;
                $hs->homestay_photo[1]->save();
            }
            else{
                $pho1 = new HomestayPhoto();
                $pho1->homestay_id = $hs->id;
                $pho1->index = 2;
                $pho1->path = $img1_path;
                $pho1->save();
            }
        }

        if($file2!=null){
            $request->validate([
                'upload2' => 'image'
            ]);
            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img2_path = 'img2_'.$dt.'.'.$file2->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file2, $img2_path);
            $img2_path = 'homestay_img/'.$temp.'/'.$img2_path;

            if($count>=3){
                Storage::delete($hs->homestay_photo[2]->path);
                $hs->homestay_photo[2]->homestay_id = $hs->id;
                $hs->homestay_photo[2]->index = 3;
                $hs->homestay_photo[2]->path = $img2_path;
                $hs->homestay_photo[2]->save();
            }
            else{
                $pho2 = new HomestayPhoto();
                $pho2->homestay_id = $hs->id;
                $pho2->index = 3;
                $pho2->path = $img2_path;
                $pho2->save();
            }
        }
        if($file3!=null){
            $request->validate([
                'upload3' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img3_path = 'img3_'.$dt.'.'.$file3->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file3, $img3_path);
            $img3_path = 'homestay_img/'.$temp.'/'.$img3_path;

            if($count>=4){
                Storage::delete($hs->homestay_photo[3]->path);
                $hs->homestay_photo[3]->homestay_id = $hs->id;
                $hs->homestay_photo[3]->index = 4;
                $hs->homestay_photo[3]->path = $img3_path;
                $hs->homestay_photo[3]->save();
            }
            else{
                $pho3 = new HomestayPhoto();
                $pho3->homestay_id = $hs->id;
                $pho3->index = 4;
                $pho3->path = $img3_path;
                $pho3->save();
            }
        }
        if($file4!=null){
            $request->validate([
                'upload4' => 'image'
            ]);

            $dt = new DateTime();
            $dt = $dt->format('Ymd_His');
            $temp = $this->getName($request->name, 10);
            $img4_path = 'img4_'.$dt.'.'.$file4->getClientOriginalExtension();
            Storage::putFileAs('homestay_img/'.$temp.'/', $file4, $img4_path);
            $img4_path = 'homestay_img/'.$temp.'/'.$img4_path;

            if($count>=5){
                Storage::delete($hs->homestay_photo[4]->path);
                $hs->homestay_photo[4]->homestay_id = $hs->id;
                $hs->homestay_photo[4]->index = 5;
                $hs->homestay_photo[4]->path = $img4_path;
                $hs->homestay_photo[4]->save();
            }
            else{
                $pho4 = new HomestayPhoto();
                $pho4->homestay_id = $hs->id;
                $pho4->index = 5;
                $pho4->path = $img4_path;
                $pho4->save();
            }
        }

        $countnp = count($hs->nearby_place);

        if($countnp>=1) {
            $hs->nearby_place[0]->name = $request->nearbyplace1;
            $hs->nearby_place[0]->distance = $request->nearbydistance1;
            $hs->nearby_place[0]->save();
        }else if($request->nearbydistance1!=null && $request->nearbyplace1!=null) {
            $np1 = new NearbyPlace();
            $np1->homestay_id = $hs->id;
            $np1->name = $request->nearbyplace1;
            $np1->distance = $request->nearbydistance1;
            $np1->save();
        }

        if($countnp>=2){
            $hs->nearby_place[1]->name = $request->nearbyplace2;
            $hs->nearby_place[1]->distance = $request->nearbydistance2;
            $hs->nearby_place[1]->save();
        }else if($request->nearbydistance2!=null && $request->nearbyplace2!=null) {
            $np2 = new NearbyPlace();
            $np2->homestay_id = $hs->id;
            $np2->name = $request->nearbyplace2;
            $np2->distance = $request->nearbydistance2;
            $np2->save();
        }

        if($countnp>=3){
            $hs->nearby_place[2]->name = $request->nearbyplace3;
            $hs->nearby_place[2]->distance = $request->nearbydistance3;
            $hs->nearby_place[2]->save();
        }else if($request->nearbydistance3!=null && $request->nearbyplace3!=null) {
            $np3 = new NearbyPlace();
            $np3->homestay_id = $hs->id;
            $np3->name = $request->nearbyplace3;
            $np3->distance = $request->nearbydistance3;
            $np3->save();
        }

        if($countnp>=4){
            $hs->nearby_place[3]->name = $request->nearbyplace4;
            $hs->nearby_place[3]->distance = $request->nearbydistance4;
            $hs->nearby_place[3]->save();
        }else if($request->nearbydistance4!=null && $request->nearbyplace4!=null) {
            $np4 = new NearbyPlace();
            $np4->homestay_id = $hs->id;
            $np4->name = $request->nearbyplace4;
            $np4->distance = $request->nearbydistance4;
            $np4->save();
        }

        $countpp = count($hs->popular_place);

        if($countpp>=1) {
            $hs->popular_place[0]->name = $request->popularplace1;
            $hs->popular_place[0]->distance = $request->populardistance1;
            $hs->popular_place[0]->save();
        }else if($request->distance1!=null && $request->place1!=null) {
            $pp1 = new PopularPlace();
            $pp1->homestay_id = $hs->id;
            $pp1->name = $request->place1;
            $pp1->distance = $request->distance1;
            $pp1->save();
        }

        if($countpp>=2){
            $hs->popular_place[1]->name = $request->popularplace2;
            $hs->popular_place[1]->distance = $request->populardistance2;
            $hs->popular_place[1]->save();
        }else if($request->populardistance2!=null && $request->popularplace2!=null) {
            $np2 = new PopularPlace();
            $np2->homestay_id = $hs->id;
            $np2->name = $request->popularplace2;
            $np2->distance = $request->populardistance2;
            $np2->save();
        }

        if($countpp>=3){
            $hs->popular_place[2]->name = $request->popularplace3;
            $hs->popular_place[2]->distance = $request->populardistance3;
            $hs->popular_place[2]->save();
        }else if($request->populardistance3!=null && $request->popularplace3!=null) {
            $np3 = new PopularPlace();
            $np3->homestay_id = $hs->id;
            $np3->name = $request->popularplace3;
            $np3->distance = $request->populardistance3;
            $np3->save();
        }

        if($countpp>=4){
            $hs->popular_place[3]->name = $request->popularplace4;
            $hs->popular_place[3]->distance = $request->populardistance4;
            $hs->popular_place[3]->save();
        }else if($request->populardistance4!=null && $request->popularplace4!=null) {
            $np4 = new PopularPlace();
            $np4->homestay_id = $hs->id;
            $np4->name = $request->popularplace4;
            $np4->distance = $request->populardistance4;
            $np4->save();
        }

        if ($oldhs_name != $hs->name){
            Storage::deleteDirectory('homestay_img/'.$this->getName($oldhs_name, 10));
        }

        return redirect()->route('tableHomestay');
    }
    public function deleteHomestay(Request $request, $id){
        $homestay = Homestay::find($id);
        $homestay->nearby_place->each->delete();
        $homestay->popular_place->each->delete();

        // Storage::delete($homestay->thumbnail);
        // foreach ($homestay->photo as $key) {
        //     Storage::delete($key->path);
        // }
        Storage::deleteDirectory('homestay_img/'.$homestay->name);

        $homestay->homestay_photo->each->delete();
        $homestay->comment_list->each->delete();
        $homestay->delete();
        return redirect()->back()->with('success', 'Homestay deleted successfully');
    }

}
