<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\RiskInfo;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class RiskInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $ri = RiskInfo::query();
            if($request->has('for_downstream')){
                $ri = $ri->with(['distributionStatus']);
                if($request->for_downstream==1){
                    $ri = $ri->where('ri_type', 'App\Models\DownStreamNotification');
                }

                if($request->has('ri_id')){
                    $ri = $ri->where('ri_id', $request->ri_id);
                }
            }
            return DataTables::of($ri->get())->make();
        }

        return ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->has('notification_type') || !$request->has('notification_id'))
            return redirect()->back()->withInput()->withError('Notifikasi tidak terdefinisi');
        
        
        $risk = new RiskInfo;
        return view('backadmin.risk_info.form', [
            'title' => 'Tambah Info Resiko',
            'risk' => $risk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'distribution_status_id' => ['required', 'max:255'],
        ]);

        try {
            DB::beginTransaction();
            switch ($request->notification_type) {
                case 'downstream':
                    $notification = DownStreamNotification::find($request->notification_id);
                    break;
                
                case 'upstream':
                    $notification = UpStreamNotification::find($request->notification_id);
                    break;

                default:
                    # code...
                    break;
            }


            $risk = $notification->risks()->make($request->only(
                'distribution_status_id',
                'serious_risk',
                'victim',
                'symptom'
            ));
            $risk->save();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.risk_infos.edit', $risk->id)
            ->withSuccess('Info Resiko berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RiskInfo $riskInfo)
    // public function edit($id)
    {

        // dd($riskInfo);
        // $risk = RiskInfo::find($id);
        // dd($risk);
        // return $risk;
        return view('backadmin.risk_info.form', [
            'title' => "Edit Resiko",
            'risk' => $riskInfo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskInfo $riskInfo)
    // public function update(Request $request, $id)
    {
        $request->validate([
            'distribution_status_id' => ['required', 'max:255'],
        ]);

        try {
            DB::beginTransaction();
            // $risk = RiskInfo::find($id);
            $riskInfo->fill($request->only(
                'distribution_status_id',
                'serious_risk',
                'victim',
                'symptom'
            ));
            $riskInfo->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.risk_infos.edit', $riskInfo->id)
            ->withSuccess('Info Resiko berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiskInfo $riskInfo)
    // public function destroy($id)
    {
        try {
            DB::beginTransaction();
            // $risk = RiskInfo::find($id);
            $riskInfo->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.risk_infos.index')
                ->withSuccess('Info Resiko berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
