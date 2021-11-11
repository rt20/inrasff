<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownStreamNotification;
use App\Models\DownStreamUserAccess;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DownStreamUserAccessController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $d = DownStreamUserAccess::query();
            $d = $d->with('user.institution', 'downstream');

            if($request->has('ds_id')){
                $d = $d->where('downstream_id', $request->ds_id);
            }

            return DataTables::of($d)->make();
        }
        return;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => ['required'],
            'downstream_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);

            if(DownStreamUserAccess::where('downstream_id', $request->downstream_id)->where('user_id', $request->user_id)->first() != null)
                throw new Exception("Pengguna tersebut telah di berikan akses untuk downstream ini", 1);
                
            $dsua = DownStreamUserAccess::make($request->only([
                'downstream_id',
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
            $dsua = DownStreamUserAccess::find($id);
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
