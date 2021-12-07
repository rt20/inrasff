<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationBase;

class NotificationBaseController extends Controller
{
    function getS2Options(Request $request) {
        $term = $request->q;
        $query = NotificationBase::select(['id','name'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%');
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  NotificationBase::select(['id', 'name'])
            ->where('id', $request->id);

        return $query->first();
    }
}
