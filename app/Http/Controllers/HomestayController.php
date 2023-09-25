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

        $q      = $attr['q'] ?? null;
        $sort   = $attr['sort'] ?? null;
        $filter = $attr['filter'] ?? null;
        $asc    = $attr['asc'] ?? null;

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
            'homestays' => $query->paginate(4)
        ]);
    }
}
