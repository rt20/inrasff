<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\TraceabilityLotInfo;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class TraceabilityLotInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $tli = TraceabilityLotInfo::query();
            if($request->has('for_downstream')){
                if($request->for_downstream==1){
                    $tli = $tli->where('tli_type', 'App\Models\DownStreamNotification');
                }

                if($request->has('tli_id')){
                    $tli = $tli->where('tli_id', $request->tli_id);
                }
            }
            return DataTables::of($tli->get())->make();
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
        
        
        $tli = new TraceabilityLotInfo;
        return view('backadmin.traceability_lot_info.form', [
            'title' => 'Tambah Info Keterlusuran Lot',
            'traceability_lot' => $tli,
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
            'source_country_id' => ['required'],
            'number' => ['required'],
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


            $tli = $notification->traceabilityLot()->make($request->only(
                'source_country_id',
                'number',
                'used_by',
                'best_before',
                'sell_by',
                'number_unit',
                'net_weight',
                'cert_number',
                'cert_date',
                'cert_institution',
                'add_cert_number',
                'add_cert_date',
                'add_cert_institution'
            ));
            $tli->save();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.traceability_lot_infos.edit', $tli->id)
            ->withSuccess('Info Keterlusuran Lot berhasil dibuat');
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
    public function edit(TraceabilityLotInfo $traceabilityLotInfo)
    {

        return view('backadmin.traceability_lot_info.form', [
            'title' => "Edit Keterlusuran Lot",
            'traceability_lot' => $traceabilityLotInfo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TraceabilityLotInfo $traceabilityLotInfo)
    // public function update(Request $request, $id)
    {
        $request->validate([
            'source_country_id' => ['required'],
            'number' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            // $tli = TraceabilityLotInfo::find($id);
            $traceabilityLotInfo->fill($request->only(
                'source_country_id',
                'number',
                'used_by',
                'best_before',
                'sell_by',
                'number_unit',
                'net_weight',
                'cert_number',
                'cert_date',
                'cert_institution',
                'add_cert_number',
                'add_cert_date',
                'add_cert_institution'
            ));
            $traceabilityLotInfo->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.traceability_lot_infos.edit', $traceabilityLotInfo->id)
            ->withSuccess('Info Keterlusuran Lot berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TraceabilityLotInfo $traceabilityLotInfo)
    // public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $traceabilityLotInfo->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.traceability_lot_infos.index')
                ->withSuccess('Info Keterlusuran Lot berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
