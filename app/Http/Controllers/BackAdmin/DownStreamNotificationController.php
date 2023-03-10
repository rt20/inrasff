<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\NotificationAttachment;
use App\Models\Institution;

use App\Events\DownStreamEmailNotification;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

// use App\Events\DownStreamInstitutionMailNotification;

use UploadFile;

class DownStreamNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view downstream')) {
            abort(401);
        }

        if ($request->ajax()) {
            $d = DownStreamNotification::query();
            if ($request->user->institution_id != null) {
                $institution_id = $request->user->institution_id;
                $d = $d->whereHas('downstreamInstitution', function ($q) use ($institution_id) {
                    $q->where('institution_id', $institution_id);
                });
                $d = $d->whereIn('status', ['ccp process', 'done']);
            }

            if ($request->has('filter_status') && $request->filter_status != 'all') {
                $d = $d->where('status', $request->filter_status);
            }

            return DataTables::of($d->get())->addIndexColumn()->make();
        }

        return view('backadmin.downstream.index')->with([
            'title' => 'Downstream'
        ]);
    }

    public function attachmentDataTable(Request $request)
    {
        if (!Gate::allows('view attachment')) {
            abort(401);
        }
        if ($request->ajax()) {
            $na = NotificationAttachment::query();
            $na = $na->where('na_type', 'App\Models\DownStreamNotification');
            if ($request->has('na_id')) {
                $na = $na->where('na_id', $request->na_id);
            }
            return DataTables::of($na)->make();
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
        if (!Gate::allows('store downstream')) {
            abort(401);
        }
        $downstream = new DownStreamNotification;
        if ($request->has('notif_id')) {
            $downstream->notif_id = $request->notif_id;
        }
        $downstream->status = 'draft';
        return view('backadmin.downstream.form', [
            'title' => 'Tambah Downstream',
            'downstream' => $downstream,
            'focus' => null
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
        if (!Gate::allows('store downstream')) {
            abort(401);
        }
        $request->validate([
            'title' => ['required', 'max:255'],
            'status_notif_id' => ['required', 'max:255'],
            'origin_source_notif' => ['required', 'max:255'],
            'source_notif' => ['required', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'brand_name' => ['required', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $downstream = DownStreamNotification::make($request->only([
                'notif_id',
                'title',
                'status_notif_id',
                'type_notif_id',
                'country_id',
                'based_notif_id',
                'origin_source_notif',
                'source_notif',
                'date_notif',
                'product_name',
                'category_product_id',
                'brand_name',
                'registration_number',
                'package_product'
            ]));
            $downstream->number = 'IN.DS.' . Carbon::now()->format('Hisv');
            $downstream->author_id = auth()->user()->id;
            $downstream->setStatus('open', 'Dibuat ');
            $downstream->save();

            /**
             * Add default NCP Institution 
             */
            $downstream->downstreamInstitution()->create([
                'institution_id' => Institution::where('type', 'ncp')->first()->id ?? 6,
                'write' => true,
                'status' => 'assigned',
            ]);

            foreach ($downstream->downstreamInstitution as $i => $d_institution) {
                $users = $d_institution->institution->users;
                foreach ($users as $j => $user) {
                    event(new DownStreamEmailNotification($downstream, $user));
                }
            }

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
    public function edit(Request $request, DownStreamNotification $downstream)
    {
        if (!Gate::allows('view downstream')) {
            abort(401);
        }

        //Filter Access
        $institution_access =  $downstream->downstreamInstitution()->pluck('institution_id')->toArray();
        // return $institution_access;
        if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
            if (!in_array(auth()->user()->institution_id, $institution_access)) {
                abort(401);
            }

            if (!in_array($downstream->status, ['ccp process', 'done'])) {
                // return redirect()->route('backadmin.downstreams.index');
                abort(401);
            }
        }

        return view('backadmin.downstream.form', [
            'title' => $downstream->number,
            'downstream' => $downstream,
            'focus' => $request->focus ?? null,
            'type_infos' => NotificationAttachment::INFOS
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
        if (!Gate::allows('store downstream')) {
            abort(401);
        }
        $request->validate([
            'title' => ['required', 'max:255'],
            'status_notif_id' => ['required', 'max:255'],
            'origin_source_notif' => ['required', 'max:255'],
            'source_notif' => ['required', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'brand_name' => ['required', 'max:255'],
            'institution'  => ['max:255'],
            'contact_person'  => ['max:255'],
        ]);

        try {
            DB::beginTransaction();
            $downstream->fill($request->only([
                'notif_id',
                'title',
                'status_notif_id',
                'type_notif_id',
                'country_id',
                'based_notif_id',
                'origin_source_notif',
                'source_notif',
                'date_notif',
                'product_name',
                'category_product_id',
                'brand_name',
                'registration_number',
                'package_product',
                'institution',
                'contact_person',
                'others'
            ]));
            if ($downstream->isStatus('draft', false)) {
                $downstream->setStatus('open', 'Diupdate dari draft');
                foreach ($downstream->downstreamInstitution as $i => $d_institution) {
                    if ($d_institution->status === 'draft') {
                        $users = $d_institution->institution->users;
                        foreach ($users as $j => $user) {
                            event(new DownStreamEmailNotification($downstream, $user));
                        }
                        $d_institution->status = 'assigned';
                        $d_institution->update();
                    }
                }
            }
            if ($request->country_id == null) {
                $downstream->country_id = null;
            }
            $downstream->update();

            // $draft_institutions =  $downstream->downstreamInstitution()
            //             ->where('status', 'draft')
            //             ->get();


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

    public function processCcp(Request $request, DownStreamNotification $downstream)
    {
        if (!Gate::allows('process_ccp downstream')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            if ($downstream->downstreamInstitution()->count() < 1)
                throw new Exception("Belum ada lembaga yang ditambahkan untuk info penindak", 1);

            $downstream->isStatus('open');
            $downstream->setStatus('ccp process', 'Diproses untuk CCP ');
            $downstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.downstreams.edit', $downstream->id)
            ->withSuccess('Downstream berhasil diproses untuk CCP');
    }

    public function backCcp(Request $request, DownStreamNotification $downstream)
    {
        try {
            DB::beginTransaction();
            $downstream->isStatus('ext process');
            $downstream->setStatus('ccp process', 'Dikembalikan untuk proses CCP ');
            $downstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.downstreams.edit', $downstream->id)
            ->withSuccess('Downstream berhasil dikembalikan untuk proses CCP');
    }

    public function processExt(Request $request, DownStreamNotification $downstream)
    {
        try {
            DB::beginTransaction();
            // dd($downstream);
            $downstream->isStatus('ccp process');
            $downstream->setStatus('ext process', 'Diproses untuk Eksternal ');
            $downstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.downstreams.edit', $downstream->id)
            ->withSuccess('Downstream berhasil diproses untuk Eksternal');
    }

    public function done(Request $request, DownStreamNotification $downstream)
    {
        if (!Gate::allows('finish downstream')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            // dd($downstream);
            // $downstream->isStatus('ext process');
            $downstream->isStatus('ccp process');
            $downstream->setStatus('done', 'Diselesaikan ', 'finished_at');
            $downstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.downstreams.edit', $downstream->id)
            ->withSuccess('Downstream berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DownStreamNotification $downstream)
    {
        if (!Gate::allows('delete downstream')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $downstream->isStatusAny(['draft', 'open']);
            if ($downstream->notification != null) {
                $downstream->notification->status = 'read';
                $downstream->notification->update();
            }
            // return $downstream->notification;

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

    public function addAttachment(Request $request)
    {
        if (!Gate::allows('store d_attachment')) {
            abort(401);
        }
        $validator = Validator::make($request->all(), [
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'attachment' => ['required', 'mimes:jpg,jpeg,png,pdf,xls,xlsx', 'max:10240'],
            'info' => ['required'],
            'title_attachment' => ['required', 'max:30'],
        ]);

        try {
            DB::beginTransaction();
            if ($validator->fails())
                throw new Exception(implode($validator->messages()->all()));

            switch ($request->notification_type) {
                case 'downstream':
                    $notification = DownStreamNotification::find($request->notification_id);
                    break;

                default:
                    # code...
                    break;
            }

            $attachment = $notification->attachment()->make();
            $name = '';
            $new_title = Str::slug($request->title_attachment);
            $res = UploadFile::uploadFile(
                $request->file('attachment'),
                'notification/attachment/',
                '[NA-' . Carbon::now()->format('Hisv') . ']' . $new_title,
                function ($new_name) use (&$name) {
                    $name = $new_name;
                }
            );
            if ($res !== "All Process success") {
                throw new Exception($res);
            }
            $attachment->link = $name;
            $attachment->title = $request->title_attachment;
            $attachment->info = $request->info;
            $attachment->notification_type = $request->notification_type;
            $attachment->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
        return response()->json([
            'status' => 'ok',
            'message' => ''
        ], 200);
    }

    public function deleteAttachment($id)
    {
        if (!Gate::allows('delete u_attachment')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $a = NotificationAttachment::find($id);
            $a->delete();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => '',
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),

            ], 400);
        }
    }

    public function report(Request $request, DownStreamNotification $downstream)
    {

        //Filter Access
        $institution_access =  $downstream->downstreamInstitution()->pluck('institution_id')->toArray();
        // return $institution_access;
        if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
            if (!in_array(auth()->user()->institution_id, $institution_access)) {
                abort(401);
            }

            if (!in_array($downstream->status, ['ccp process', 'done'])) {
                // return redirect()->route('backadmin.downstreams.index');
                abort(401);
            }
        }

        $url = route('backadmin.downstreams.edit', $downstream->id);
        $alphabet = range('A', 'ZZ');
        return view('report.notification')
            ->with([
                'title' => $downstream->number,
                'url' => $url,
                'notification' => $downstream,
                'alphabet' => $alphabet
            ]);
    }
}
