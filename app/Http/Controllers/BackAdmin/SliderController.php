<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderImage;

use Exception;
use UploadFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $s = Slider::all();
            return DataTables::of($s)->make();
        }

        return view('backadmin.slider.index')->with([
            'title' => 'Slider'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $s = Slider::where('id', $id)  
            ->with('sliderImage')
            ->first();
        $s->settings = json_decode($s->settings);
        return view('backadmin.slider.form', [
            'title' => $s->name,
            'slider' => $s,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage(Request $request){
        $validator = Validator::make($request->all(), [
            'slider_id' => ['bail', 'required'],
            'image' => ['bail','image','required','mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        try {
            DB::beginTransaction();
            if($validator->fails()){
                throw new Exception(implode($validator->messages()->all()));
            }
            $si = SliderImage::make($request->only([
                'title', 'subtitle', 'link'
            ]));
            $si->slider_id = $request->slider_id;
            $si->save();

            $s = Slider::find($request->slider_id);
            $settings = $s->getSettings();

            $name = '';
            $res = UploadFile::uploadImage(
                $request->file('image'),
                'slider_image/',
                'SI-'.Carbon::now()->format('Hisv'),
                [
                    'main' => [
                        'width' => $settings['width']?? 1280,
                        'height' => $settings['height']?? 720
                    ]
                ],
                function($new_name) use (&$name){
                    $name = $new_name;
                }
            );
            if($res !== "All Process success"){
                throw new Exception($res);
            }
            $si->image = $name;
            $si->save();

            DB::commit();
            return response()->json([
                'status' => 'ok',
                'message' => '',
                'data' => $si
            ], 201);
        } catch (Exception $e) {
            report($e);
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                
            ], 400);
        }
    }

    public function deleteImage($id){
        try {
            DB::beginTransaction();
            $si = SliderImage::find($id);
            if($si->image != null){
                File::delete(storage_path('app/public/slider_image/'.$si->image));
                File::delete(storage_path('app/public/slider_image/thumb_'.$si->image));
            }
            $si->delete();
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
