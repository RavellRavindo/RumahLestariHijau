<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private function saveImage($image)
    {
        $savefile = Str::orderedUuid().'.'.$image->getClientOriginalExtension();
        Storage::putFileAs('assets/', $image, $savefile);
        return $savefile;
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

        return redirect('/tableDestination');
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

        // $arr = $request->toArray();
        // $rq_arr = array_chunk(array_splice($arr, 5, count($arr)), 3);

        // //check if min and max person value from input have duplicate
        // $rq_person = array_merge(array_column($rq_arr, '0'), array_column($rq_arr, '1'));
        // if ( count($rq_person) !== count(array_unique($rq_person)) ){
        //     return redirect()->back()->with('failed', 'min or max person got duplicate');
        // }

        // //check if price value from input have duplicate
        // $rq_price = array_column($rq_arr, '2');
        // if ( count($rq_price) !== count(array_unique($rq_price)) ){
        //     return redirect()->back()->with('failed', 'price got duplicate');
        // }

        // $desprice = DestinationPrice::where('destination_id', $id)->orderBy('min_person', 'asc')->get();

        // $idx = 0;
        // foreach ($desprice as $dprice){
        //     if ( $dprice->min_person != $rq_arr[$idx][0] || $dprice->max_person != $rq_arr[$idx][1]
        //         || $dprice->price != $rq_arr[$idx][2])
        //         {
        //             if ($rq_arr[$idx][0] >= $rq_arr[$idx][1]){
        //                 // min > max person. failed
        //                 return redirect()->back()->with('failed', 'min person bigger than max person');
        //             }

        //             $dprice->min_person = $rq_arr[$idx][0];
        //             $dprice->max_person = $rq_arr[$idx][1];
        //             $dprice->price = $rq_arr[$idx][2];
        //             $dprice->save();
        //         }
        //     $idx++;
        // }

        // if (count($rq_arr) > $desprice->count())
        // {
        //     $dprice = new DestinationPrice();
        //     $dprice->destination_id = $id;
        //     $dprice->min_person = $rq_arr[$idx][0];
        //     $dprice->max_person = $rq_arr[$idx][1];
        //     $dprice->price = $rq_arr[$idx][2];
        //     $dprice->save();
        // }

        return redirect('/tableDestination');
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

        return redirect('/tableCulinary');
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

        return redirect('/tableCulinary');
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
