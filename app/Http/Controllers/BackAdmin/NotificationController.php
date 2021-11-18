<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $n = Notification::all();
            return DataTables::of($n)->make();
        }

        return view('backadmin.notification.index')->with([
            'title' => 'Notifikasi'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.notification.form', [
            'title' => 'Tambah Notifikasi',
            'notification' => new Notification,
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
            'title' => ['required', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $notification = Notification::make($request->only([
                'title', 'description']));
            $notification->author_id = auth()->user()->id;
            $notification->setStatus('unread', 'Dibuat ');
            $notification->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.notifications.edit', $notification->id)
            ->withSuccess('Notifikasi berhasil dibuat');
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
    public function edit(Notification $notification)
    {
        // $notification = Notification::find($id);
        if($notification->isStatus('unread', false)){
            $notification->setStatus('read', 'Dibaca ');
            $notification->update();
        }
        return view('backadmin.notification.form', [
            'title' => $notification->number,
            'notification' => $notification,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $notification->fill($request->only([
                'title', 'description']));
            $notification->update();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.notifications.edit', $notification->id)
            ->withSuccess('Notifikasi berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        try {
            DB::beginTransaction();
            $notification->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.notifications.index')
                ->withSuccess('Notifikasi berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function processDownstream(Request  $request, Notification $notification){
        // return $notification;

        try {
            DB::beginTransaction();
            
            $downstream = $notification->downstream()->make([
                // 'number_ref' => $notification->number,
                'title' => 'Proses Downstream Dokumen '.$notification->number,
                'number' => 'IN.DS.'.Carbon::now()->format('Hisv')
            ]);
            $downstream->author_id =  auth()->user()->id;
            $downstream->setStatus('draft', 'Dibuat untuk Proses Downstream Dokumen'.$notification->number);
            // dd($downstream);
            $downstream->save();
            $notification->setStatus('processed', 'Diproses untuk Downstream '.$downstream->number);
            $notification->update();

            DB::commit();

            return redirect()
                ->route('backadmin.downstreams.edit', $downstream->id)
                ->withSuccess('Notifikasi berhasil diproses menjadi Downstream');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function processUpstream(Request  $request, Notification $notification){
        

        try {
            DB::beginTransaction();
            
            $upstream = $notification->upstream()->make([
                'number_ref' => $notification->number,
                'title' => 'Proses Upstream Dokumen '.$notification->number,
                'number' => 'IN.US.'.Carbon::now()->format('Hisv')
            ]);
            $upstream->author_id =  auth()->user()->id;
            $upstream->setStatus('draft', 'Dibuat untuk Proses Upstream Dokumen'.$notification->number);
            // dd($upstream);
            $upstream->save();
            $notification->setStatus('processed', 'Diproses untuk Upstream '.$upstream->number);
            $notification->update();

            DB::commit();

            return redirect()
                ->route('backadmin.upstreams.edit', $upstream->id)
                ->withSuccess('Notifikasi berhasil diproses menjadi Upstream');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
