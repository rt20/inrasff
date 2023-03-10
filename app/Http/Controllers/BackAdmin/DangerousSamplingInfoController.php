<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DangerousInfo;
use App\Models\DangerousSamplingInfo;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DangerousSamplingInfoController extends Controller
{
    public function index(Request $request){
        $s = DangerousSamplingInfo::query();

        if($request->has('di_id')){
            $s = $s->where('di_id', $request->di_id);
        }

        return DataTables::of($s)->make();
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'di_id' => ['required'],
            'sampling_date' => ['required'],
            'sampling_count' => ['required']
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails())
                throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);

            $d = DangerousInfo::find($request->di_id);
            $s = $d->sampling()->create($request->only([
                'sampling_date',
                'sampling_count',
                'sampling_method',
                'sampling_place',

                'name_result',
                'uom_result_id',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance'
            ]));

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

    public function show($id){
        return response()->json([
            'status' => 'ok',
            'message' => '',
            'data' => DangerousSamplingInfo::find($id)
        ], 200);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'sampling_date' => ['required'],
            'sampling_count' => ['required']
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails()){
                $errors = $validator->errors();
                // $errors = implode(", ", $errors);
                throw new Exception($errors, 1);
                
                // throw new Exception("Input validasi bermasalah, cek kembali inputan!", 1);
            }
                
                

            $s = DangerousSamplingInfo::find($id);
            $s = $s->fill($request->only([
                'sampling_date',
                'sampling_count',
                'sampling_method',
                'sampling_place',

                'name_result',
                'uom_result_id',
                'laboratorium',
                'matrix',
                'scope',
                'max_tollerance'
            ]))->update();

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

    public function delete($id){
        try {
            DB::beginTransaction();
            $s = DangerousSamplingInfo::find($id);
            $s->delete();
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
