<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpStreamNotification;
use App\Models\NotificationAttachment;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
        if($request->ajax()){
            $d = UpStreamNotification::all();
            return DataTables::of($d)->make();
        }

        return view('backadmin.upstream.index')->with([
            'title' => 'Upstream'
        ]);
    }

    public function attachmentDataTable(Request $request){
        if($request->ajax()){
            $na = NotificationAttachment::query();
            $na = $na->where('na_type', 'App\Models\UpStreamNotification');
            if($request->has('na_id')){
                $na = $na->where('na_id', $request->na_id);
            }
            return DataTables::of($na)->make();
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
        $upstream = new UpStreamNotification;
        if($request->has('notif_id')){
            $upstream->notif_id = $request->notif_id;
        }
        return view('backadmin.upstream.form', [
            'title' => 'Tambah Upstream',
            'upstream' => $upstream,
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
            'number_ref' => ['required', 'max:255'],
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
                'number_ref',
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
            $upstream->number = 'IN.US'.Carbon::now()->format('Hisv');
            $upstream->author_id = auth()->user()->id;
            $upstream->setStatus('open', 'Dibuat ');
            $upstream->save();
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
    public function edit(UpStreamNotification $upstream)
    {
        // $upstream->dangerousRisk;
        
        return view('backadmin.upstream.form', [
            'title' => $upstream->number,
            'upstream' => $upstream,
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
        $request->validate([
            'title' => ['required', 'max:255'],
            'number_ref' => ['required', 'max:255'],
            'status_notif_id' => ['required', 'max:255'],
            'origin_source_notif' => ['required', 'max:255'],
            'source_notif' => ['required', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'brand_name' => ['required', 'max:255'],
        ]);
        
        try {
            DB::beginTransaction();
                $upstream->fill($request->only([
                    'notif_id',
                    'title',
                    'number_ref',
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
                $upstream->update();
           
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

    public function backOpen(Request $request, UpStreamNotification $upstream){
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
        try {
            DB::beginTransaction();
                // dd($upstream);
                $upstream->isStatus('ext process');
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
        try {
            DB::beginTransaction();
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

    public function addAttachment(Request $request){
        $validator = Validator::make($request->all(), [
            'notification_type' => ['required'], //upstream or upstream
            'notification_id' => ['required'], //id for upstream or upstream
            'attachment' => ['required', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
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
            $res = UploadFile::uploadFile(
                $request->file('attachment'),
                'notification/attachment/',
                'NA-'.Carbon::now()->format('Hisv'),
                function($new_name) use (&$name){
                    $name = $new_name;                    
                }
            );
            if($res !== "All Process success"){
                throw new Exception($res);
            }
            $attachment->title = $name;
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

    public function deleteAttachment($id){
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
}
