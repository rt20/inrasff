<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\TraceabilityLotInfo;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class TraceabilityLotInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view traceability')) {
            abort(401);
        }
        if ($request->ajax()) {
            $tli = TraceabilityLotInfo::query();
            $tli = $tli->with('sourceCountry');

            if ($request->has('for_downstream')) {
                if ($request->for_downstream == 1) {
                    $tli = $tli->where('tli_type', 'App\Models\DownStreamNotification');
                }

                if ($request->has('tli_id')) {
                    $tli = $tli->where('tli_id', $request->tli_id);
                }
            }

            if ($request->has('for_upstream')) {
                if ($request->for_upstream == 1) {
                    $tli = $tli->where('tli_type', 'App\Models\UpStreamNotification');
                }

                if ($request->has('tli_id')) {
                    $tli = $tli->where('tli_id', $request->tli_id);
                }
            }
            return DataTables::of($tli->get())->make();
        }

        return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if (!Gate::allows('store traceability')) {
        //     abort(401);
        // }

        if ($request->has('notification_type')) {
            if ($request->notification_type === 'upstream') {

                if (!Gate::allows('store u_traceability')) {
                    abort(401);
                }
            }
        } else {
            if (!Gate::allows('store d_traceability')) {
                abort(401);
            }
        }

        if (!$request->has('notification_type') || !$request->has('notification_id'))
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
        // if (!Gate::allows('store traceability')) {
        //     abort(401);
        // }

        if ($request->has('notification_type')) {
            if ($request->notification_type === 'upstream') {
                if (!Gate::allows('store u_traceability')) {
                    abort(401);
                }
            }
        } else {
            if (!Gate::allows('store d_traceability')) {
                abort(401);
            }
        }

        $request->validate([
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'source_country_id' => ['required'],
            'number' => ['required', 'max:255'],

            'number_unit' => ['max:255'],
            // 'net_weight' => ['max:255', 'numeric'],
            'net_weight' => ['numeric'],
            'cert_number' => ['max:255'],
            'cert_institution' => ['max:255'],

            'add_cert_number' => ['max:255'],
            'add_cert_institution' => ['max:255'],

            'cved_number' => ['max:255'],

            'producer_name' => ['max:255'],
            // 'producer_address' => ['max:255'],
            'producer_city' => ['max:255'],
            'producer_approval' => ['max:255'],

            'importer_name' => ['max:255'],
            // 'importer_address' => ['max:255'],
            'importer_city' => ['max:255'],
            'importer_approval' => ['max:255'],

            'wholesaler_name' => ['max:255'],
            // 'wholesaler_address' => ['max:255'],
            'wholesaler_city' => ['max:255'],
            'wholesaler_approval' => ['max:255'],
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
                'add_cert_institution',
                'cved_number',
                'producer_name',
                'producer_address',
                'producer_city',
                'producer_country_id',
                'producer_approval',
                'importer_name',
                'importer_address',
                'importer_city',
                'importer_country_id',
                'importer_approval',
                'wholesaler_name',
                'wholesaler_address',
                'wholesaler_city',
                'wholesaler_country_id',
                'wholesaler_approval',
            ));
            $tli->notification_type = $request->notification_type;
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
        if (!Gate::allows('view traceability')) {
            abort(401);
        }

        if (str_replace('App\\Models\\', '', $traceabilityLotInfo->tli_type) === 'UpStreamNotification') {
            $institution_access =  $traceabilityLotInfo->notification->upstreamInstitution()->pluck('institution_id')->toArray();
        } else {
            $institution_access =  $traceabilityLotInfo->notification->downstreamInstitution()->pluck('institution_id')->toArray();
            if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
                if (!in_array($traceabilityLotInfo->notification->status, ['ccp process', 'done'])) {
                    abort(401);
                }
            }
        }

        if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
            if (!in_array(auth()->user()->institution_id, $institution_access)) {
                abort(401);
            }
        }

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
        // if (!Gate::allows('store traceability')) {
        //     abort(401);
        // }

        if (str_replace('App\\Models\\', '', $traceabilityLotInfo->tli_type) === 'UpStreamNotification') {
            if (!Gate::allows('store u_traceability')) {
                abort(401);
            }
        } else {
            if (!Gate::allows('store d_traceability')) {
                abort(401);
            }
        }

        $request->validate([
            'source_country_id' => ['required'],
            'number' => ['required', 'max:255'],

            'number_unit' => ['max:255'],
            // 'net_weight' => ['max:255', 'numeric'],
            'net_weight' => ['numeric'],
            'cert_number' => ['max:255'],
            'cert_institution' => ['max:255'],

            'add_cert_number' => ['max:255'],
            'add_cert_institution' => ['max:255'],

            'cved_number' => ['max:255'],

            'producer_name' => ['max:255'],
            // 'producer_address' => ['max:255'],
            'producer_city' => ['max:255'],
            'producer_approval' => ['max:255'],

            'importer_name' => ['max:255'],
            // 'importer_address' => ['max:255'],
            'importer_city' => ['max:255'],
            'importer_approval' => ['max:255'],

            'wholesaler_name' => ['max:255'],
            // 'wholesaler_address' => ['max:255'],
            'wholesaler_city' => ['max:255'],
            'wholesaler_approval' => ['max:255'],
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
                'add_cert_institution',
                'cved_number',
                'producer_name',
                'producer_address',
                'producer_city',
                'producer_country_id',
                'producer_approval',
                'importer_name',
                'importer_address',
                'importer_city',
                'importer_country_id',
                'importer_approval',
                'wholesaler_name',
                'wholesaler_address',
                'wholesaler_city',
                'wholesaler_country_id',
                'wholesaler_approval',
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
        // if (!Gate::allows('delete traceability')) {
        //     abort(401);
        // }

        if (str_replace('App\\Models\\', '', $traceabilityLotInfo->tli_type) === 'UpStreamNotification') {
            if (!Gate::allows('store u_traceability')) {
                abort(401);
            }
        } else {
            if (!Gate::allows('store d_traceability')) {
                abort(401);
            }
        }

        try {
            DB::beginTransaction();
            // $number = $traceabilityLotInfo->notification->number;
            $notification_type = $traceabilityLotInfo->notification_type;
            $id = $traceabilityLotInfo->notification->id;
            $traceabilityLotInfo->delete();

            // dd("delete traceability");
            DB::commit();

            // if (str_contains($number, "IN.DS")) {
            if ($notification_type === "downstream") {
                return redirect()
                    ->route('backadmin.downstreams.edit', ['downstream' => $id, 'focus' => 'traceability_lots'])
                    ->withSuccess('Info Bahaya berhasil dihapus');
                // } else  if (str_contains($number, "IN.US")) {
            } else if ($notification_type === "upstream") {
                return redirect()
                    ->route('backadmin.upstreams.edit', ['upstream' => $id, 'focus' => 'traceability_lots'])
                    ->withSuccess('Info Bahaya berhasil dihapus');
            } else {
                return redirect()
                    ->route('backadmin.dashboard')
                    ->withSuccess('Info Bahaya berhasil dihapus');
            }

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
