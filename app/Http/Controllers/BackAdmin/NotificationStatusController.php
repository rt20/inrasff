<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationStatus;

class NotificationStatusController extends Controller
{
    function getS2Options(Request $request) {
        $term = $request->q;
        $query = NotificationStatus::select(['id','name'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%');
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  NotificationStatus::select(['id', 'name'])
            ->where('id', $request->id);

        return $query->first();
    }
}
