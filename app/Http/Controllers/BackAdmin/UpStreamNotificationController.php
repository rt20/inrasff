<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpStreamNotification;
use App\Models\NotificationAttachment;
use App\Events\UpStreamEmailNotification;
use App\Models\Institution;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use UploadFile;

class UpStreamNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view upstream')) {
            abort(401);
        }
        if ($request->ajax()) {
            $d = UpStreamNotification::query();
            if ($request->user->institution_id != null) {
                $institution_id = $request->user->institution_id;
                $d = $d->whereHas('upstreamInstitution', function ($q) use ($institution_id) {
                    $q->where('institution_id', $institution_id);
                });
            }

            if ($request->has('filter_status') && $request->filter_status != 'all') {
                $d = $d->where('status', $request->filter_status);
            }

            return DataTables::of($d->get())->addIndexColumn()->make();
        }

        return view('backadmin.upstream.index')->with([
            'title' => 'Upstream'
        ]);
    }

    public function attachmentDataTable(Request $request)
    {
        if (!Gate::allows('view attachment')) {
            abort(401);
        }
        if ($request->ajax()) {
            $na = NotificationAttachment::query();
            $na = $na->where('na_type', 'App\Models\UpStreamNotification');
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
        if (!Gate::allows('store upstream')) {
            abort(401);
        }
        $upstream = new UpStreamNotification;
        $upstream->status = 'draft';
        if ($request->has('notif_id')) {
            $upstream->notif_id = $request->notif_id;
        }
        return view('backadmin.upstream.form', [
            'title' => 'Tambah Upstream',
            'upstream' => $upstream,
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
        if (!Gate::allows('store upstream')) {
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
            $upstream = UpStreamNotification::make($request->only([
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
            $upstream->number = 'IN.US.' . Carbon::now()->format('Hisv');
            $upstream->author_id = auth()->user()->id;
            $upstream->setStatus('open', 'Dibuat ');
            $upstream->save();

            $upstream->upstreamInstitution()->create([
                'institution_id' => Institution::where('type', 'ncp')->first()->id ?? 6,
                'write' => true,
                'status' => 'assigned',
            ]);

            switch ($request->user->type) {
                case 'ccp':
                    $upstream->upstreamInstitution()->create([
                        'institution_id' => $request->user->institution->id,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    break;
                case 'lccp':
                    $upstream->upstreamInstitution()->create([
                        'institution_id' => $request->user->institution->id,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    $upstream->upstreamInstitution()->create([
                        'institution_id' => $request->user->institution->parent_id,
                        'write' => true,
                        'status' => 'assigned',
                    ]);
                    # code...
                    break;
                default:
                    # code...
                    break;
            }

            // dd($upstream->upstreamInstitution);
            foreach ($upstream->upstreamInstitution as $i => $u_institution) {

                $users = $u_institution->institution->users;

                foreach ($users as $j => $user) {
                    event(new UpStreamEmailNotification($upstream, $user));
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.upstreams.edit', $upstream->id)
            ->withSuccess('Upstream berhasil dibuat');
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
    public function edit(Request $request, UpStreamNotification $upstream)
    {
        if (!Gate::allows('view upstream')) {
            abort(401);
        }

        //Filter Access
        $institution_access =  $upstream->upstreamInstitution()->pluck('institution_id')->toArray();
        if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
            if (!in_array(auth()->user()->institution_id, $institution_access)) {
                abort(401);
            }
        }

        return view('backadmin.upstream.form', [
            'title' => $upstream->number,
            'upstream' => $upstream,
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
    public function update(Request $request, UpStreamNotification $upstream)
    {
        if (!Gate::allows('store upstream')) {
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

            $upstream->fill($request->only([
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
            if ($upstream->isStatus('draft', false)) {
                $upstream->setStatus('open', 'Diupdate dari draft');
            }
            if ($request->country_id == null) {
                $upstream->country_id = null;
            }
            $upstream->update();

            foreach ($upstream->upstreamInstitution as $i => $u_institution) {
                if ($u_institution->status === 'draft') {
                    $users = $u_institution->institution->users;
                    foreach ($users as $j => $user) {
                        event(new UpStreamEmailNotification($upstream, $user));
                    }
                    $u_institution->status = 'assigned';
                    $u_institution->update();
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.upstreams.edit', $upstream->id)
            ->withSuccess('Upstream berhasil dibuat');
    }

    public function backOpen(Request $request, UpStreamNotification $upstream)
    {
        try {
            DB::beginTransaction();

            $upstream->isStatus('ext process');
            $upstream->setStatus('open', 'Dikembalikan untuk edit ');
            $upstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.upstreams.edit', $upstream->id)
            ->withSuccess('Upstream berhasil dikembalikan untuk edit');
    }

    public function processExt(Request $request, UpStreamNotification $upstream)
    {

        try {
            DB::beginTransaction();
            // dd($upstream);
            $upstream->isStatus('open');
            $upstream->setStatus('ext process', 'Diproses untuk CCP ');
            $upstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.upstreams.edit', $upstream->id)
            ->withSuccess('Upstream berhasil diproses untuk CCP');
    }

    public function done(Request $request, UpStreamNotification $upstream)
    {
        if (!Gate::allows('finish upstream')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            // dd($upstream);
            // $upstream->isStatus('ext process');
            $upstream->isStatus('open');
            $upstream->setStatus('done', 'Diselesaikan ', 'finished_at');
            $upstream->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());
        }
        return redirect()
            ->route('backadmin.upstreams.edit', $upstream->id)
            ->withSuccess('Upstream berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpStreamNotification $upstream)
    {
        if (!Gate::allows('delete upstream')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $upstream->isStatusAny(['draft', 'open']);
            if ($upstream->notification != null) {
                $upstream->notification->status = 'read';
                $upstream->notification->update();
            }
            $upstream->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.upstreams.index')
                ->withSuccess('Upstream berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function addAttachment(Request $request)
    {
        if (!Gate::allows('store u_attachment')) {
            abort(401);
        }
        $validator = Validator::make($request->all(), [
            'notification_type' => ['required'], //upstream or upstream
            'notification_id' => ['required'], //id for upstream or upstream
            'attachment' => ['required', 'mimes:jpg,jpeg,png,pdf,xls,xlsx', 'max:10240'],
            'info' => ['required'],
            'title_attachment' => ['required', 'max:30'],
        ]);

        try {
            DB::beginTransaction();
            if ($validator->fails())
                throw new Exception(implode($validator->messages()->all()));

            switch ($request->notification_type) {
                case 'upstream':
                    $notification = UpStreamNotification::find($request->notification_id);
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

    public function report(Request $request, UpStreamNotification $upstream)
    {
        //Filter Access
        $institution_access =  $upstream->upstreamInstitution()->pluck('institution_id')->toArray();
        if (!in_array(auth()->user()->type, ['superadmin', 'ncp'])) {
            if (!in_array(auth()->user()->institution_id, $institution_access)) {
                abort(401);
            }
        }

        $alphabet = range('A', 'ZZ');
        $url = route('backadmin.upstreams.edit', $upstream->id);
        return view('report.notification')
            ->with([
                'title' => $upstream->number,
                'url' => $url,
                'notification' => $upstream,
                'alphabet' => $alphabet
            ]);
    }
}
