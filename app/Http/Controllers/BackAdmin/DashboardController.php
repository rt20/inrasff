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

        /**
         * Statistic CCP Grap
         */
        $ui = DB::table('up_stream_institutions as usi')
                ->select(
                    // 'usi.id',
                    'institutions.id',
                    'institutions.name',
                    DB::raw('count(*) as total')
                )
                ->leftJoin('institutions', 'institutions.id', '=', 'usi.institution_id')
                ->leftJoin('up_stream_notifications AS us', 'us.id', '=', 'usi.us_id')
                ->where('institutions.type', 'ccp')
                ->whereNotNull('institutions.name')
                ->where('us.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                ->where('us.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'))
                ->groupBy('institutions.id', 'institutions.name')
                ->get();

        $di = DB::table('down_stream_institutions as dsi')
                ->select(
                    'institutions.id',
                    'institutions.name',
                    DB::raw('count(*) as total')
                )
                ->leftJoin('institutions', 'institutions.id', '=', 'dsi.institution_id')
                ->leftJoin('down_stream_notifications AS ds', 'ds.id', '=', 'dsi.ds_id')
                ->where('institutions.type', 'ccp')
                ->whereNotNull('institutions.name')
                ->where('ds.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                ->where('ds.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'))
                ->groupBy('institutions.id', 'institutions.name')
                ->get();        
        $stats = [];

        foreach ($di as $i => $d) {
            $stats[$d->name] = [
                'downstream' => $d->total,
                'upstream' => 0
            ];
        }
        foreach ($ui as $i => $u) {
            $stats[$u->name]['upstream'] = $u->total;
            if(!isset($stats[$u->name]['downstream'])){
                $stats[$u->name]['downstream'] = 0;
            }
        }
        $axis_institution = [];
        $axis_downstream = [];
        $axis_upstream = [];
        foreach ($stats as $key => $stat) {
            array_push($axis_institution, $key);
            array_push($axis_downstream, $stat['downstream']);
            array_push($axis_upstream, $stat['upstream']);
        }
        /**
         * End of Statistic Graph
         */

        

        $user = auth()->user();
        
        $ds =  DB::table('down_stream_notifications as ds')
                ->select(
                    'ds.id',
                )
                ->select(
                    DB::raw('count(ds.id) as total'),
                    // DB::raw("DATE_FORMAT(ds.created_at, '%Y-%m-01') month")
                    DB::raw("DATE_FORMAT(ds.created_at, '%Y') month")
                )
                ->whereNull('deleted_at')
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->limit(3);

        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $ds = $ds->join('down_stream_institutions', 'ds.id', '=', 'down_stream_institutions.ds_id')
                        ->where('down_stream_institutions.institution_id', $user->institution_id);
        }

        $ds = $ds->get();
        
        // return $ds;
        $dss = DB::table('down_stream_notifications as ds')
                ->select(
                    'ds.id',
                    'ds.status',
                )
                ->select(
                    'ds.status',
                    DB::raw('count(ds.id) as total'),
                );
        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $dss = $dss->join('down_stream_institutions', 'ds.id', '=', 'down_stream_institutions.ds_id')
                        ->where('down_stream_institutions.institution_id', $user->institution_id);
        }
        $dss = $dss->whereNull('deleted_at')
                // ->where('ds.created_at', '>=', Carbon::now()->format('Y-m-01'))
                // ->where('ds.created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )))
                ->where('ds.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                ->where('ds.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'))
                ->groupBy('ds.status');
                
        $dss = $dss->get()
                ->groupBy(function($val){
                    return $val->status;
                });
        
        $downstream_month = DB::table('down_stream_notifications as ds')
                                    ->whereNull('ds.deleted_at')
                                    // ->where('ds.created_at', '>=', Carbon::now()->format('Y-m-01'))
                                    // ->where('ds.created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )));
                                    ->where('ds.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                                    ->where('ds.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'));
        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $downstream_month = $downstream_month->join('down_stream_institutions', 'ds.id', '=', 'down_stream_institutions.ds_id')
                        ->where('down_stream_institutions.institution_id', $user->institution_id);
        }
        $downstream_month = $downstream_month->count();

        $downstream_graph = [];
        $downstream_graph_year = [];
        if(isset($ds[0]) && isset($ds[1])){
            $downstream_diff_last_month = ($ds[0]->total - $ds[1]->total)/$ds[1]->total;
        }else{
            $downstream_diff_last_month = $ds[0]->total;
        }

        $last_month = Carbon::now()->subMonth()->isoFormat('MMMM Y');
        
        foreach ($ds as $i => $d) {
            array_push($downstream_graph, $d->total);
            array_push($downstream_graph_year, 'Tahun ' .$d->month);
        }
        
        $us =  DB::table('up_stream_notifications as us')
                ->select(
                    'us.id',
                )
                ->select(
                    DB::raw('count(us.id) as total'),
                    DB::raw("DATE_FORMAT(us.created_at, '%Y') month")
                    // DB::raw("DATE_FORMAT(us.created_at, '%Y-%m-01') month")
                )
                ->whereNull('deleted_at')
                ->groupBy('month')
                ->orderBy('month', 'DESC')
                ->limit(3);
        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $us = $us->join('up_stream_institutions', 'us.id', '=', 'up_stream_institutions.us_id')
                        ->where('up_stream_institutions.institution_id', $user->institution_id);
        }
        $us = $us->get();
                
        $uss = DB::table('up_stream_notifications as us')
                ->select(
                    'us.id',
                    'us.status',
                )
                ->select(
                    'us.status',
                    DB::raw('count(us.id) as total'),
                );
        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $uss = $uss->join('up_stream_institutions', 'us.id', '=', 'up_stream_institutions.us_id')
                        ->where('up_stream_institutions.institution_id', $user->institution_id);
        }
        $uss = $uss->whereNull('us.deleted_at')
                // ->where('us.created_at', '>=', Carbon::now()->format('Y-m-01'))
                // ->where('us.created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )))
                ->where('us.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                ->where('us.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'))
                ->groupBy('us.status')
                ->get()
                ->groupBy(function($val){
                    return $val->status;
                });
        // $upstream_month = isset($us[0])? $us[0]->total : 0;
        $upstream_month = DB::table('up_stream_notifications as us')
                                    ->whereNull('deleted_at')
                                    // ->where('us.created_at', '>=', Carbon::now()->format('Y-m-01'))
                                    // ->where('us.created_at', '<=', Carbon::make((new DateTime())->format( 'Y-m-t' )));
                                    ->where('us.created_at', '>=', Carbon::now()->startOfYear()->format('Y-m-d'))
                                    ->where('us.created_at', '<=', Carbon::now()->endOfYear()->format('Y-m-d'));
        if(!in_array($user->type, ['ncp', 'superadmin'])){
            $upstream_month = $upstream_month->join('up_stream_institutions', 'us.id', '=', 'up_stream_institutions.us_id')
                        ->where('up_stream_institutions.institution_id', $user->institution_id);
        }
        $upstream_month = $upstream_month->count();
        $upstream_graph = [];
        $upstream_graph_year = [];
        if(isset($us[0]) && isset($us[1])){
            $upstream_diff_last_month = ($us[0]->total - $us[1]->total)/$us[1]->total;
        }else{
            $upstream_diff_last_month = $us[0]->total;
        }

        $last_month = 'Tahun ' .Carbon::now()->subYear()->isoFormat('Y');
        
        foreach ($us as $i => $d) { 
            array_push($upstream_graph, $d->total);
            array_push($upstream_graph_year, 'Tahun ' .$d->month);
        }

        return view('backadmin.dashboard.dashboard',[
            'title' => null,
            'downstream_graph' => $downstream_graph,
            'downstream_graph_year' => $downstream_graph_year,
            'downstream_month' => $downstream_month,
            'downstream_diff_last_month' => $downstream_diff_last_month,
            
            'downstream_status' => $dss,

            'upstream_graph' => $upstream_graph,
            'upstream_graph_year' => $upstream_graph_year,
            'upstream_month' => $upstream_month,
            'upstream_diff_last_month' => $upstream_diff_last_month,
            'upstream_status' => $uss,

            'last_month' => $last_month,

            'axis_institution' =>$axis_institution,
            'axis_downstream' =>$axis_downstream,
            'axis_upstream' =>$axis_upstream
        ]);
    }
}
