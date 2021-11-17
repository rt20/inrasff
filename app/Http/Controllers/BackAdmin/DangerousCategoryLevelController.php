<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DangerousCategoryLevel;

class DangerousCategoryLevelController extends Controller
{
    function getS2Options(Request $request) {
        $term = $request->q;
        $level = $request->level;
        $parent_id = $request->parent_id;
        $dc_id = $request->dc_id;
        $query = DangerousCategoryLevel::select(['id', 'name', 'has_child'])
            ->where(function($q) use ($term , $level, $dc_id, $parent_id) {
                $q->where('name', 'like', '%' . $term . '%')
                    ->where('level', $level);
                    // ->where('parent_id', $parent_id);

                if($dc_id != null){
                    $q= $q->where('dc_id', $dc_id);
                }
                if($parent_id!=null){
                    $q = $q->where('parent_id', $parent_id);
                }
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  DangerousCategoryLevel::select(['id', 'name', 'has_child'])
            ->where('id', $request->id);

        return $query->first();
    }
}
