<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\DownStreamInstitution;
use App\Models\User;
use App\Events\DownStreamEmailNotification;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DownStreamInstitutionController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $d = DownStreamInstitution::with(['institution', 'downstream']);

            if($request->has('read')){
                $d = $d->where('read', $request->read);
            }
            if($request->has('write')){
                $d = $d->where('write', $request->write);
            }

            if($request->has('ds_id')){
                $d = $d->where('ds_id', $request->ds_id);
            }

            return DataTables::of($d->get())->make();
        }

        return ;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'institution_id' => ['required'],
            'ds_id' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);
            if(DownStreamInstitution::where('ds_id', $request->ds_id)->where('institution_id', $request->institution_id)->first() != null)
                throw new Exception("Lembaga tersebut telah di berikan akses untuk downstream ini", 1);
            
            
            $dsi = DownStreamInstitution::make($request->only([
                'ds_id',
                'institution_id',
            ]));
            $dsi->write = $request->write==="true" ? true : false;
            $dsi->status = 'assigned';
            $dsi->save();

            if($dsi->write){
                $users = $dsi->institution->users;
                foreach ($users as $i => $user) {
                    // $dsua = $dsi->downstream->downstreamUserAccess()->create([
                    //     'user_id' => $user->id,
                    // ]);
                    
                    event(new DownStreamEmailNotification($dsi->downstream, $user));
                }
                
            }

            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => ''
            ], 200);
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);            
        }  
    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $dsi = DownStreamInstitution::find($id);
            // if($dsi->write){
            //     $dsi->downstream
            //         ->downstreamUserAccess()
            //         ->whereIn(
            //             'user_id', 
            //             $dsi->institution->users()->pluck('id')
            //         )
            //         ->delete();
            // }
            $dsi->delete();
            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => ''
            ], 200);
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);            
        }  
    }
}
