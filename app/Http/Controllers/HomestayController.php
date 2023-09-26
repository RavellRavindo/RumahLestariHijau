<?php

namespace App\Http\Controllers;

use App\Models\Homestay;

class HomestayController extends Controller
{
    public function homestayPage()
    {
        $attr = request()->validate([
            'q' => 'regex:/^[a-zA-Z \.,]+$/u|max:255',
            'sort' => 'in:price_asc,price,rating',
            'filter' => 'regex:/^[a-z\,]+$/u|max:32',
            'asc' => 'in:false,true'
        ]);

        $q      = $attr['q'] ?? null;
        $sort   = $attr['sort'] ?? null;
        $filter = $attr['filter'] ?? null;

        $query = Homestay::selectRaw('*');
        $filterList = [];

        if (!empty($filter)) {
            $queryFilter = [];

            foreach (explode(',', $filter) as $f) {
                if (in_array($f, ['wifi', 'parking', 'ac', 'restaurant'])) {
                    array_push($queryFilter, ['has_'.$f, '=', true]);
                    array_push($filterList, $f);
                }
            }

            $query = $query->where($queryFilter);
        }

        if (!empty($q)) {
            $query = $query->search($q);
        }

        if (!empty($sort)) {
            $asc = false;
            $sortc = $sort;

            if (str_ends_with($sort, '_asc')) {
                $sortc = substr($sort, 0, -4);
                $asc = true;
            }

            if (in_array($sortc, ['price', 'rating'])) {
                $query = $query->orderBy($sortc, $asc == 'true' ? 'asc' : 'desc');
            }
        }

        return view('homestay', [
            'homestays' => $query->paginate(4),
            'sort' => $sort,
            'filters' => $filterList
        ]);
    }

    
    public function homestayDetailPage($id)
    {
        return view('homestayDetail', [
            'data' => Homestay::findOrFail($id)
        ]);
    }
}
