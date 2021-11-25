<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

use UploadFile;
use Carbon\Carbon;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $n = Gallery::all();
            return DataTables::of($n)->make();
        }

        return view('backadmin.gallery.index')->with([
            'title' => 'Gallery'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.gallery.form', [
            'title' => 'Tambah Gallery',
            'gallery' => new Gallery,
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
            'image' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = Gallery::create($request->only(['title']));
            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'gallery/',
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
            ->route('backadmin.galleries.edit', $n->id)
            ->withSuccess('Gallery berhasil dibuat');
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
        $c = Gallery::find($id);
        return view('backadmin.gallery.form', [
            'title' => 'Edit Gallery',
            'gallery' => $c,
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
        ]);
        try {
            DB::beginTransaction();
            $n = Gallery::find($id);
            $n->fill($request->only(['title']));
            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'gallery/',
                    'A-'.Carbon::now()->format('Hisv'),
                    null,
                    function($new_name) use (&$name){
                        $name = $new_name;
                    }
                );
                if($res !== "All Process success"){
                    throw new Exception($res);
                }
                File::delete(storage_path('app/public/gallery/'.$n->image));
                File::delete(storage_path('app/public/gallery/thumb_'.$n->image));
                
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
            ->route('backadmin.galleries.edit', $n->id)
            ->withSuccess('Gallery berhasil diubah');
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
            $n = Gallery::find($id);
            if($n->image != null){
                File::delete(storage_path('app/public/gallery/'.$n->image));
                File::delete(storage_path('app/public/gallery/thumb_'.$n->image));
            }
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.galleries.index')
                ->withSuccess('Gallery berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
