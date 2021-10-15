<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\FollowUpNotification;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class FollowUpNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $bci = FollowUpNotification::query();
            if($request->has('for_downstream')){
                if($request->for_downstream==1){
                    $bci = $bci->where('fun_type', 'App\Models\DownStreamNotification');
                }

                if($request->has('fun_id')){
                    $bci = $bci->where('fun_id', $request->fun_id);
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
        
        
        $follow_up = new FollowUpNotification;
        return view('backadmin.follow_up.form', [
            'title' => 'Tambah Tindak Lanjut',
            'follow_up' => $follow_up,
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
            'title' => ['required', 'max:255'],
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


            $follow_up = $notification->followUp()->make($request->only(
                'title',
                'description',
            ));
            $follow_up->author_id = auth()->user()->id;
            $follow_up->save();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.follow_ups.edit', $follow_up->id)
            ->withSuccess('Info Tindak Lanjut berhasil dibuat');
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
    public function edit(FollowUpNotification $followUp)
    // public function edit($id)
    {
        return view('backadmin.follow_up.form', [
            'title' => "Edit Tindak Lanjut",
            'follow_up' => $followUp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUpNotification $followUp)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        try {
            DB::beginTransaction();
            // $follow_up = FollowUpNotification::find($id);
            $followUp->fill($request->only(
                'title',
                'description',
            ));
            $followUp->update();
           
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.follow_ups.edit', $followUp->id)
            ->withSuccess('Info Tindak Lanjut berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUpNotification $followUp)
    {
        try {
            DB::beginTransaction();
            // $follow_up = FollowUpNotification::find($id);
            $followUp->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.follow_ups.index')
                ->withSuccess('Info Tindak Lanjut berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
