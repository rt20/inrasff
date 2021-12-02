<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DownStreamNotification as Downstream;
use App\Models\UpStreamNotification as Upstream;
use Carbon\Carbon;
use DateTime;

class DashboardController extends Controller
{
    public function index(Request $request){
        
        $ds =  DB::table('down_stream_notifications as ds')
                ->select(
                    'ds.id',
                )
                ->select(
                    DB::raw('count(ds.id) as total'),
                    DB::raw("DATE_FORMAT(ds.created_at, '%Y-%m-01') month")
                )
                ->whereNull('deleted_at')
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->limit(2)
                ->get();
        $dss = DB::table('down_stream_notifications as ds')
                ->select(
                    'ds.id',
                    'ds.status',
                )
                ->select(
                    'ds.status',
                    DB::raw('count(ds.id) as total'),
                )
                ->whereNull('deleted_at')
                ->where('created_at', '>=', Carbon::now()->format('Y-m-01'))
                ->where('created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )))
                ->groupBy('status')
                ->get()
                ->groupBy(function($val){
                    return $val->status;
                });
        $downstream_month = isset($ds[0])? $ds[0]->total : 0;
        $downstream_graph = [];
        if(isset($ds[0]) && isset($ds[1])){
            $downstream_diff_last_month = ($ds[0]->total - $ds[1]->total)/$ds[1]->total;
        }else{
            $downstream_diff_last_month = 0;
        }

        $last_month = Carbon::now()->subMonth()->isoFormat('MMMM Y');
        
        foreach ($ds as $i => $d) {
            array_push($downstream_graph, $d->total);
        }
        
        $us =  DB::table('up_stream_notifications as us')
                ->select(
                    'us.id',
                )
                ->select(
                    DB::raw('count(us.id) as total'),
                    DB::raw("DATE_FORMAT(us.created_at, '%Y-%m-01') month")
                )
                ->whereNull('deleted_at')
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->limit(2)
                ->get();
        $uss = DB::table('up_stream_notifications as us')
                ->select(
                    'us.id',
                    'us.status',
                )
                ->select(
                    'us.status',
                    DB::raw('count(us.id) as total'),
                )
                ->whereNull('deleted_at')
                ->where('created_at', '>=', Carbon::now()->format('Y-m-01'))
                ->where('created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )))
                ->groupBy('status')
                ->get()
                ->groupBy(function($val){
                    return $val->status;
                });
        $upstream_month = isset($us[0])? $us[0]->total : 0;
        $upstream_graph = [];
        if(isset($us[0]) && isset($us[1])){
            $upstream_diff_last_month = ($us[0]->total - $us[1]->total)/$us[1]->total;
        }else{
            $upstream_diff_last_month = 0;
        }

        $last_month = Carbon::now()->subMonth()->isoFormat('MMMM Y');
        
        foreach ($us as $i => $d) {
            array_push($upstream_graph, $d->total);
        }
        return view('backadmin.dashboard.dashboard',[
            'title' => null,
            'downstream_graph' => $downstream_graph,
            'downstream_month' => $downstream_month,
            'downstream_diff_last_month' => $downstream_diff_last_month,
            'last_month' => $last_month,
            'downstream_status' => $dss,

            'upstream_graph' => $upstream_graph,
            'upstream_month' => $upstream_month,
            'upstream_diff_last_month' => $upstream_diff_last_month,
            'upstream_status' => $uss,
        ]);
    }
}
