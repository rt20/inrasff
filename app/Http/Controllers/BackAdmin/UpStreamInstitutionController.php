<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpStreamNotification;
use App\Models\UpStreamInstitution;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UpStreamInstitutionController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $d = UpStreamInstitution::with(['institution', 'upstream']);

            if($request->has('read')){
                $d = $d->where('read', $request->read);
            }
            if($request->has('write')){
                $d = $d->where('write', $request->write);
            }

            if($request->has('us_id')){
                // dd($request->us_id);
                $d = $d->where('us_id', $request->us_id);
            }

            return DataTables::of($d->get())->make();
        }

        return ;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'institution_id' => ['required'],
            'us_id' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);
            if(UpStreamInstitution::where('us_id', $request->us_id)->where('institution_id', $request->institution_id)->first() != null)
                throw new Exception("Lembaga tersebut telah di berikan akses untuk upstream ini", 1);
                
            $dsi = UpStreamInstitution::make($request->only([
                'us_id',
                'institution_id',
            ]));
            $dsi->write = $request->write==="true" ? true : false;
            $dsi->save();
              
            if($dsi->write){
                $users = $dsi->institution->users;
                // foreach ($users as $i => $user) {
                //     $dsi->upstream->upstreamUserAccess()->create([
                //         'user_id' => $user->id
                //     ]);
                // }
                
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
            $dsi = UpStreamInstitution::find($id);
            // if($dsi->write){
            //     $dsi->upstream
            //         ->upstreamUserAccess()
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
