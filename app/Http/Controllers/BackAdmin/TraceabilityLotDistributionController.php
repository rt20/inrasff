<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TraceabilityLotInfo;
use App\Models\TraceabilityLotDistribution as Distribution;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TraceabilityLotDistributionController extends Controller
{
    public function index(Request $request){
        // if ($request->ajax()) {
            $d = Distribution::with(['country']);

            if($request->has('tl_id')){
                $d = $d->where('tl_id', $request->tl_id);
            }

            return DataTables::of($d->get())->make();
        // }

        return ;
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'country_id' => ['required'],
            'tl_id' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);
            if(Distribution::where('country_id', $request->country_id)->where('tl_id', $request->tl_id)->first() != null)
                throw new Exception("Negara tersebut telah ditambahkan untuk keterlusuran ini", 1);
                
            $d = Distribution::make($request->only([
                'country_id',
                'tl_id'
            ]));
            $d->save();

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
            $d = Distribution::find($id);
            $d->delete();
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
