<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kementrian;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

use UploadFile;
use Carbon\Carbon;

class KementrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $n = Kementrian::all();
            return DataTables::of($n)->make();
        }

        return view('backadmin.kementrian.index')->with([
            'title' => 'Kementerian'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.kementrian.form', [
            'title' => 'Tambah Kementerian',
            'kementrian' => new Kementrian,
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
            'content' => ['required', 'max:255'],
            'link' => ['required', 'max:255'],
            'image' => ['image', 'mimes: jpeg,jpg,png', 'max:2048'],
        ]);
        try {
            DB::beginTransaction();
            $n = Kementrian::make($request->only(['title', 'content', 'link', 'facebook', 'twitter', 'instagram']));

            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'kementrian/',
                    'A-'.Carbon::now()->format('Hisv'),
                    null,
                    function($new_name) use (&$name){
                        $name = $new_name;
                    }
                );
                if($res !== "All Process success"){
                    throw new Exception($res);
                }
                $n->image = $name;
                $n->save();
            }
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.kementrian.edit', $n->id)
            ->withSuccess('Kementerian berhasil dibuat');
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
        $n = Kementrian::find($id);
        return view('backadmin.kementrian.form', [
            'title' => 'Edit Kementerian',
            'kementrian' => $n,
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
        $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:255'],
            'link' => ['required', 'max:255'],
            'image' => ['image', 'mimes: jpeg,jpg,png', 'max:2048'],
        ]);
        try {
            DB::beginTransaction();
            $n = Kementrian::find($id);
            $n->fill($request->only(['title', 'content', 'link', 'facebook', 'twitter', 'instagram']));

            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'kementrian/',
                    'A-'.Carbon::now()->format('Hisv'),
                    null,
                    function($new_name) use (&$name){
                        $name = $new_name;
                    }
                );
                if($res !== "All Process success"){
                    throw new Exception($res);
                }
                File::delete(storage_path('app/public/kementrian/'.$n->image));
                File::delete(storage_path('app/public/kementrian/thumb_'.$n->image));
                
                $n->image = $name;
                $n->save();
            }
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.kementrian.edit', $n->id)
            ->withSuccess('Kementerian berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $n = Kementrian::find($id);
            
            if($n->image != null){
                File::delete(storage_path('app/public/kementrian/'.$n->image));
                File::delete(storage_path('app/public/kementrian/thumb_'.$n->image));
            }
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.kementrian.index')
                ->withSuccess('Kementerian berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
