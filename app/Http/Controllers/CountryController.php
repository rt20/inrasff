<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Get select2 options
     */
    function getS2Options(Request $request) {
        $term = $request->q;
        $query = Country::select(['id','name', 'code'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%')
                    ->orWhere('code', 'like', '%' . $term . '%');
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  Country::select(['id', 'name', 'code'])
            ->where('id', $request->id);

        return $query->first();
    }
}
