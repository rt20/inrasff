<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\BorderControlInfo;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class BorderControlInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $bci = BorderControlInfo::query();
            $bci = $bci->with('destinationCountry');
            if($request->has('for_downstream')){
                if($request->for_downstream==1){
                    $bci = $bci->where('bci_type', 'App\Models\DownStreamNotification');
                }

                if($request->has('bci_id')){
                    $bci = $bci->where('bci_id', $request->bci_id);
                }
            }
            return DataTables::of($bci->get())->make();
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
        
        
        $border_control = new BorderControlInfo;
        return view('backadmin.border_control_info.form', [
            'title' => 'Tambah Kontrol Perbatasan',
            'border_control' => $border_control,
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
            'start_point' => ['required', 'max:255'],
            'entry_point' => ['required', 'max:255'],
            'supervision_point' => ['required', 'max:255'],
            'destination_country_id' => ['required'],
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


            $border_control = $notification->borderControl()->make($request->only(
                'start_point',
                'entry_point',
                'supervision_point',
                'destination_country_id',
                'consignee_name',
                'consignee_address',
                'container_number',
                'transport_name',
                'transport_description',
            ));
            $border_control->save();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.border_control_infos.edit', $border_control->id)
            ->withSuccess('Info Kontrol Perbatasan berhasil dibuat');
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
    public function edit(BorderControlInfo $borderControlInfo)
    // public function edit($id)
    {
        return view('backadmin.border_control_info.form', [
            'title' => "Edit Kontrol Perbatasan",
            'border_control' => $borderControlInfo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BorderControlInfo $borderControlInfo)
    {
        $request->validate([
            'start_point' => ['required', 'max:255'],
            'entry_point' => ['required', 'max:255'],
            'supervision_point' => ['required', 'max:255'],
            'destination_country_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            // $border_control = BorderControlInfo::find($id);
            $borderControlInfo->fill($request->only(
                'start_point',
                'entry_point',
                'supervision_point',
                'destination_country_id',
                'consignee_name',
                'consignee_address',
                'container_number',
                'transport_name',
                'transport_description',
            ));
            $borderControlInfo->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.border_control_infos.edit', $borderControlInfo->id)
            ->withSuccess('Info Kontrol Perbatasan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BorderControlInfo $borderControlInfo)
    {
        try {
            DB::beginTransaction();
            // $border_control = BorderControlInfo::find($id);
            $borderControlInfo->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.border_control_infos.index')
                ->withSuccess('Info Kontrol Perbatasan berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
