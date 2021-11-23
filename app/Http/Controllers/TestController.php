<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownStreamUserAccess;
use App\Events\DownStreamEmailNotification;

class TestController extends Controller
{
    public function mail(){
        return view('mail.notification');
    }

    public function sendMail(){
        // $data = DownStreamUserAccess::find(2);
        // return $data->user;
        // event(new DownStreamEmailNotification($data));
    }
}
