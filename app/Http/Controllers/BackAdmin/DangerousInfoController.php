<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\DangerousInfo;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class DangerousInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $di = DangerousInfo::query();
            if($request->has('for_downstream')){
                $di = $di->with(['category']);
                if($request->for_downstream==1){
                    $di = $di->where('di_type', 'App\Models\DownStreamNotification');
                }

                if($request->has('di_id')){
                    $di = $di->where('di_id', $request->di_id);
                }
            }

            if($request->has('for_upstream')){
                $di = $di->with(['category']);
                if($request->for_upstream==1){
                    $di = $di->where('di_type', 'App\Models\UpStreamNotification');
                }

                if($request->has('di_id')){
                    $di = $di->where('di_id', $request->di_id);
                }
            }

            
            return DataTables::of($di->get())->make();
        }

        return ;
        // return view('backadmin.downstream.index')->with([
        //     'title' => 'Downstream'
        // ]);
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
        
        
        $dangerous = new DangerousInfo;
        return view('backadmin.dangerous_info.form', [
            'title' => 'Tambah Info Bahaya',
            'dangerous' => $dangerous,
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
        // return $request->all();
        $request->validate([
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'name' => ['required', 'max:255'],
            // 'category' => ['required', 'max:255'],
            'category_id' => ['required', 'max:255'],
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

            // dd($notification);

            $dangerous = $notification->dangerous()->make($request->only(
                'name',
                'category_id',
                'name_result',
                'uom_result_id',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance',
                'cl1_id',
                'cl2_id',
                'cl3_id'
            ));
            $dangerous->save();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.dangerous_infos.edit', $dangerous->id)
            ->withSuccess('Info Bahaya berhasil dibuat');
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
    public function edit(DangerousInfo $dangerousInfo)
    // public function edit($id)
    {
        // $dangerous = DangerousInfo::find($id);
        // dd($dangerous);
        // return $dangerous->notification;
        // return $dangerous->di_type;
        // return str_replace('App\\Models\\', '', $dangerous->di_type);
        return view('backadmin.dangerous_info.form', [
            'title' => $dangerousInfo->name,
            'dangerous' => $dangerousInfo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DangerousInfo $dangerousInfo)
    // public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            // 'category' => ['required', 'max:255'],
            'category_id' => ['required', 'max:255'],
        ]);

        try {
            DB::beginTransaction();
            // $dangerous = DangerousInfo::find($id);
            $dangerousInfo->fill($request->only(
                'name',
                // 'category',
                'category_id',
                'name_result',
                // 'uom_result',
                'uom_result_idp',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance',
            ));
            $dangerousInfo->cl1_id = $request->cl1_id;
            $dangerousInfo->cl2_id = $request->cl2_id;
            $dangerousInfo->cl3_id = $request->cl3_id;
            $dangerousInfo->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.dangerous_infos.edit', $dangerousInfo->id)
            ->withSuccess('Info Bahaya berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DangerousInfo $dangerousInfo)
    // public function destroy($id)
    {
        try {
            DB::beginTransaction();
            // $dangerous = DangerousInfo::find($id);
            // dd($dangerous);
            $dangerousInfo->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.dangerous_infos.index')
                ->withSuccess('Info Bahaya berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
