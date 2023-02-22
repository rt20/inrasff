<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpStreamNotification;
use App\Models\UpStreamUserAccess;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UpStreamUserAccessController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $d = UpStreamUserAccess::query();
            $d = $d->with('user.institution', 'upstream');

            if($request->has('ds_id')){
                $d = $d->where('upstream_id', $request->ds_id);
            }

            return DataTables::of($d)->make();
        }
        return;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'upstream_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);

            if(UpStreamUserAccess::where('upstream_id', $request->upstream_id)->where('user_id', $request->user_id)->first() != null)
                throw new Exception("Pengguna tersebut telah di berikan akses untuk upstream ini", 1);
                
            $dsua = UpStreamUserAccess::make($request->only([
                'upstream_id',
                'user_id',
            ]));
            $dsua->save();
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
            $dsua = UpStreamUserAccess::find($id);
            $dsua->delete();
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
