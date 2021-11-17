<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\NotificationAttachment;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;



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
        // return "Hangetng";
        if($request->ajax()){
            $d = DownStreamNotification::all();
            return DataTables::of($d)->make();
        }

        return view('backadmin.downstream.index')->with([
            'title' => 'Downstream'
        ]);
    }

    public function attachmentDataTable(Request $request){
        // if($request->ajax()){
            $na = NotificationAttachment::query();
            $na = $na->where('na_type', 'App\Models\DownStreamNotification');
            if($request->has('na_id')){
                $na = $na->where('na_id', $request->na_id);
            }
            return DataTables::of($na)->make();
        // }
        return ;
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
        // return $request->all();
        $request->validate([
            'title' => ['required', 'max:255'],
            // 'number_ref' => ['required', 'max:255'],
            // 'status_notif' => ['required', 'max:255'],
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
                // 'number_ref',
                // 'status_notif',
                'status_notif_id',
                // 'type_notif',
                'type_notif_id',
                'country_id',
                // 'based_notif',
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
            $downstream->number = 'IN.DS.'.Carbon::now()->format('Hisv');
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
    public function edit(Request $request, DownStreamNotification $downstream)
    {
        
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
        // return $request->all();   
        $request->validate([
            'title' => ['required', 'max:255'],
            // 'number_ref' => ['required', 'max:255'],
            // 'status_notif' => ['required', 'max:255'],
            'status_notif_id' => ['required', 'max:255'],
            'origin_source_notif' => ['required', 'max:255'],
            'source_notif' => ['required', 'max:255'],
            'product_name' => ['required', 'max:255'],
            'brand_name' => ['required', 'max:255'],
        ]);
        
        try {
            DB::beginTransaction();
                $downstream->fill($request->only([
                    'notif_id',
                    'title',
                    // 'number_ref',
                    // 'status_notif',
                    'status_notif_id',
                    // 'type_notif',
                    'type_notif_id',
                    'country_id',
                    // 'based_notif',
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
                }
                $downstream->update();
           
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
        
        try {
            DB::beginTransaction();
                // dd($downstream);
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

    public function backCcp(Request $request, DownStreamNotification $downstream){
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

    public function addAttachment(Request $request){
        $validator = Validator::make($request->all(), [
            'notification_type' => ['required'], //downstream or upstream
            'notification_id' => ['required'], //id for downstream or upstream
            'attachment' => ['required', 'max:2048'],
            'info' => ['required'],
            'title_attachment' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception(implode($validator->messages()->all()));
            
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
            
            $attachment = $notification->attachment()->make();
            $name = '';
            $new_title = Str::slug($request->title_attachment);
            $res = UploadFile::uploadFile(
                $request->file('attachment'),
                'notification/attachment/',
                '[NA-'.Carbon::now()->format('Hisv').']'.$new_title,
                function($new_name) use (&$name){
                    $name = $new_name;                    
                }
            );
            if($res !== "All Process success"){
                throw new Exception($res);
            }
            $attachment->link = $name;
            $attachment->title = $request->title_attachment;
            $attachment->info = $request->info;
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
