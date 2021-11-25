<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;
use App\Models\FollowUpNotification;
use App\Models\FollowUpNotificationAttachment;
// use App\Models\FollowUpUser;
use App\Models\FollowUpInstitution;
use App\Models\Institution;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

use UploadFile;

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
            if($request->has('for_upstream')){
                if($request->for_upstream==1){
                    $bci = $bci->where('fun_type', 'App\Models\UpStreamNotification');
                }

                if($request->has('fun_id')){
                    $bci = $bci->where('fun_id', $request->fun_id);
                }
            }
            return DataTables::of($bci->get())->make();
        }

        return ;
    }

    public function attachmentDataTable(Request $request){
        if($request->ajax()){
            $a = FollowUpNotificationAttachment::query();
            if($request->has('fun_id')){
                $a = $a->where('fun_id', $request->fun_id);
            }
            return DataTables::of($a)->make();
        }
        return ;
    }

    // public function userFuDataTable(Request $request){
    //     if($request->ajax()){
    //         $a = FollowUpUser::query();
    //         $a = $a->with('user.institution');
    //         if($request->has('fun_id')){
    //             $a = $a->where('fun_id', $request->fun_id);
    //         }
    //         return DataTables::of($a->get())->make();
    //     }
    //     return ;
    // }

    public function institutionFuDataTable(Request $request){
        if($request->ajax()){
            $a = FollowUpInstitution::query();
            $a = $a->with('institution');
            if($request->has('fun_id')){
                $a = $a->where('fun_id', $request->fun_id);
            }
            return DataTables::of($a->get())->make();
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

    public function process(Request $request, FollowUpNotification $followUp)
    {
        
        try {
            DB::beginTransaction();
                if($followUp->followUpInstitution()->count() < 1){
                    throw new Exception("Lembaga Notifikasi Terkait belum ditambahkan", 1);
                    
                }
                $followUp->isStatus('draft');
                $followUp->setStatus('on process', 'Diajukan ');
                if(auth()->user()->type !== 'lccp')
                    $followUp->setStatus('accepted', 'Disetujui ');
                $followUp->update();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.follow_ups.edit', $followUp->id)
            ->withSuccess('Tindak Lanjut berhasil diajukan');
    }

    public function accept(Request $request, FollowUpNotification $followUp)
    {
        
        try {
            DB::beginTransaction();
                $followUp->isStatus('on process');
                $followUp->setStatus('accepted', 'Disetujui ');
                $followUp->update();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.follow_ups.edit', $followUp->id)
            ->withSuccess('Tindak Lanjut berhasil disetujui');
    }

    public function reject(Request $request, FollowUpNotification $followUp)
    {
        
        try {
            DB::beginTransaction();
                $followUp->isStatus('on process');
                $followUp->setStatus('rejected', 'Ditolak ');
                $followUp->update();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.follow_ups.edit', $followUp->id)
            ->withSuccess('Tindak Lanjut berhasil ditolak');
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
            $followUp->attachment()->delete();
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

    public function addAttachment(Request $request){
        $validator = Validator::make($request->all(), [
            'fun_id' => ['required'],
            'attachment' => ['required', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception(implode($validator->messages()->all()));
            $attachment = FollowUpNotificationAttachment::make($request->only([
                'fun_id'
            ]));
            $name = '';
            $res = UploadFile::uploadFile(
                $request->file('attachment'),
                'follow_up/attachment/',
                'FU-'.Carbon::now()->format('Hisv'),
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

    public function addInstitutionFu(Request $request){
        $validator = Validator::make($request->all(), [
            'fun_id' => ['required'],
            'institution_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception(implode($validator->messages()->all()));
            $institution = Institution::find($request->institution_id);
            if($institution==null)
                throw new Exception("Institution not found", 1);
            $fui = FollowUpInstitution::where('fun_id', $request->fun_id)
                        ->where('institution_id', $request->institution_id)
                        ->first();
            if($fui!=null)
                throw new Exception("Lembaga sudah ditambahkan untuk tindak lanjut ini", 1);
                
            
            FollowUpInstitution::create([
                'fun_id' => $request->fun_id,
                'institution_id' => $request->institution_id
            ]);
            // $users = $institution->users;
            // foreach ($users as $i => $user) {
            //     if(FollowUpUser::where('fun_id', $request->fun_id)
            //             ->where('user_id', $user->id)->first() != null)
            //             continue;
            //     $fuu = FollowUpUser::make([
            //         'fun_id' => $request->fun_id,
            //         'user_id' => $user->id,
            //     ]); 
            //     $fuu->save();
            // }
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
            $a = FollowUpNotificationAttachment::find($id);
            // if($a->title != null){
                // File::delete(storage_path('app/public/follow_up/attachment/'.$a->title));
            // }
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

    public function deleteInstitutionFu($id){
        try {
            DB::beginTransaction();
            // $a = FollowUpUser::find($id);
            $a = FollowUpInstitution::find($id);
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
