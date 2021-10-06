<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class DownStreamNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $d = DownStreamNotification::all();
            return DataTables::of($d)->make();
        }

        return view('backadmin.downstream.index')->with([
            'title' => 'Downstream'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $downstream = new DownStreamNotification;
        if($request->has('notif_id')){
            $downstream->notif_id = $request->notif_id;
        }
        return view('backadmin.downstream.form', [
            'title' => 'Tambah Downstream',
            'downstream' => $downstream,
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
            // 'title' => ['required', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $downstream = DownStreamNotification::make($request->only([
                'notif_id'
            ]));
            $downstream->number = 'IN.DS'.Carbon::now()->format('Hisv');
            $downstream->author_id = auth()->user()->id;
            $downstream->setStatus('open', 'Dibuat ');
            $downstream->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.downstreams.edit', $downstream->id)
            ->withSuccess('Downstream berhasil dibuat');
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
    public function edit(DownStreamNotification $downstream)
    {
        return view('backadmin.downstream.form', [
            'title' => $downstream->title,
            'downstream' => $downstream,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DownStreamNotification $downstream)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DownStreamNotification $downstream)
    {
        try {
            DB::beginTransaction();
            $downstream->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.downstreams.index')
                ->withSuccess('Downstream berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
