<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownStreamUserAccess;
use App\Events\DownStreamEmailNotification;
use Carbon\Carbon;
use App\Events\TestEmail;

class TestController extends Controller
{

    public function mail(Request $request){
        if($request->has('password')){
            if($request->password==='ujuGex4q$Ynv'){
                event(new TestEmail("hermansigue@gmail.com"));
            }
        }else{
            return "invalid";
        }
        
        // return view('mail.follow_up_notification');
    }

    public function sendMail(){
        // $data = DownStreamUserAccess::find(2);
        // return $data->user;
        // event(new DownStreamEmailNotification($data));
        return Carbon::make('2021-11-24')->isoFormat('dddd, D MMM Y');
    }

    public function report(){
        // return view('report.notification');
    }
}
