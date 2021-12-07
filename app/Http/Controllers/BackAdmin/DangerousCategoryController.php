<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DangerousCategory;

class DangerousCategoryController extends Controller
{
    function getS2Options(Request $request) {
        $term = $request->q;
        $query = DangerousCategory::select(['id', 'name', 'has_child'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%');
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  DangerousCategory::select(['id', 'name', 'has_child'])
            ->where('id', $request->id);

        return $query->first();
    }
}
