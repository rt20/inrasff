<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownStreamUserAccess;
use App\Events\DownStreamEmailNotification;
use Carbon\Carbon;
use App\Events\TestEmail;
use Illuminate\Support\Facades\DB;
use App\Models\DownStreamNotification as DownStream;

class TestController extends Controller
{
    public function importTest(Request $request)
    {
        return DownStream::all();
        return DB::connection('mysql_old')
            ->table('notifikasi')
            ->where('id', 489)
            ->first();
        // ->take(10)
        // ->get();
    }

    public function mail(Request $request)
    {
        if ($request->has('password')) {
            if ($request->password === 'ujuGex4q$Ynv') {
                event(new TestEmail("hermansigue@gmail.com"));
            }
        } else {
            return redirect()->route('home');
            return "invalid";
        }

        // return view('mail.follow_up_notification');
    }

    public function sendMail()
    {
        // $data = DownStreamUserAccess::find(2);
        // return $data->user;
        // event(new DownStreamEmailNotification($data));
        return Carbon::make('2021-11-24')->isoFormat('dddd, D MMM Y');
    }

    public function report()
    {
        // return view('report.notification');
    }
}
