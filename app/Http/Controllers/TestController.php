<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownStreamUserAccess;
use App\Events\DownStreamEmailNotification;
use Carbon\Carbon;

class TestController extends Controller
{
    public function mail(){
        return view('mail.notification');
    }

    public function sendMail(){
        // $data = DownStreamUserAccess::find(2);
        // return $data->user;
        // event(new DownStreamEmailNotification($data));
        return Carbon::make('2021-11-24')->isoFormat('dddd, D MMM Y');
    }
}
