<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
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
                if($request->for_downstream==1){
                    $di = $di->where('di_type', 'App\Models\DownStreamNotification');
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
        $request->validate([
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'name' => ['required', 'max:255'],
            'category' => ['required', 'max:255'],
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
                'category',
                'name_result',
                'uom_result',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance',
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
    // public function edit(DangerousInfo $dangerous)
    public function edit($id)
    {
        $dangerous = DangerousInfo::find($id);
        // dd($dangerous);
        // return $dangerous->notification;
        // return $dangerous->di_type;
        // return str_replace('App\\Models\\', '', $dangerous->di_type);
        return view('backadmin.dangerous_info.form', [
            'title' => $dangerous->name,
            'dangerous' => $dangerous,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, DangerousInfo $dangerous)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'category' => ['required', 'max:255'],
        ]);

        try {
            DB::beginTransaction();
            $dangerous = DangerousInfo::find($id);
            $dangerous->fill($request->only(
                'name',
                'category',
                'name_result',
                'uom_result',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance',
            ));
            $dangerous->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.dangerous_infos.edit', $dangerous->id)
            ->withSuccess('Info Bahaya berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(DangerousInfo $dangerous)
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $dangerous = DangerousInfo::find($id);
            // dd($dangerous);
            $dangerous->delete();
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
