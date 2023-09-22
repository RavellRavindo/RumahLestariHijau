<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CulinaryController extends Controller
{
    public function culinaryPage()
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

        $query = Culinary::selectRaw('*');

        // if (!empty($filter)) {
        //     $queryFilter = [];
        //
        //     foreach (explode(',', $filter) as $f) {
        //         if (in_array($f, ['wifi', 'parking', 'ac', 'restaurant'])) {
        //             array_push($queryFilter, ['has_'.$f, '=', true]);
        //         }
        //     }
        //
        //     $query = $query->where($queryFilter);
        // }

        if (!empty($q)) {
            $query = $query->search($q);
        }

        if (!empty($sort)) {
            $query = $query->orderBy($sort, $asc == 'true' ? 'asc' : 'desc');
        }

        return view('culinary', [
            'culinaries' => $query->paginate(10)
        ]);
    }
}
