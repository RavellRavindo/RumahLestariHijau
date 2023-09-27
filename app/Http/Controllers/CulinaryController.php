<?php

namespace App\Http\Controllers;

use App\Models\Culinary;

class CulinaryController extends Controller
{
    public function culinaryPage()
    {
        $attr = request()->validate([
            'q' => 'regex:/^[a-zA-Z \.,]+$/u|max:255',
            'sort' => 'in:price_asc,price,rating',
            'filter' => 'regex:/^[a-z\,_]+$/u|max:32',
            'asc' => 'in:false,true'
        ]);

        $q      = $attr['q'] ?? null;
        $sort   = $attr['sort'] ?? null;
        $filter = $attr['filter'] ?? null;
        $asc    = $attr['asc'] ?? null;

        $query = Culinary::selectRaw('*');
        $filterList = [];

        if (!empty($filter)) {
            $firstWhere = true;

            foreach (explode(',', $filter) as $f) {
                if (in_array($f, ['main_course', 'side_dish', 'dessert'])) {
                    if ($firstWhere) {
                        $firstWhere = false;
                        $query = $query->where('type', '=', $f);
                    }
                    else {
                        $query = $query->orWhere('type', '=', $f);
                    }
                    array_push($filterList, $f);
                }
            }
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

        return view('culinary', [
            'culinaries' => $query->paginate(10),
            'sort' => $sort,
            'filters' => $filterList
        ]);
    }
}