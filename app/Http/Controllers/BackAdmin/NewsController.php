<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use UploadFile;
use Carbon\Carbon;
use Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view news')) {
            abort(401);
        }
        if($request->ajax()){
            $n = News::all();
            return DataTables::of($n)->addIndexColumn()->make();
        }

        return view('backadmin.news.index')->with([
            'title' => 'Berita'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('store news')) {
            abort(401);
        }
        return view('backadmin.news.form', [
            'title' => 'Tambah Berita',
            'news' => new News,
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
        if (!Gate::allows('store news')) {
            abort(401);
        }
        $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', 'unique:news'],
            'image' => ['required', 'image', 'mimes: jpeg,jpg,png', 'max:10240'],
            'published_at' => ['required'],
            'content' => ['required'],
            'excerpt' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            if(in_array(Auth::user()->type, ['ncp', 'superadmin'])) {
                $n = News::make($request->only(['title', 'slug', 'content', 'status', 'published_at', 'excerpt',  'category_id']));
            } else {
                $n = News::make($request->only(['title', 'slug', 'content', 'published_at', 'excerpt',  'category_id']));
            }
            $n->author_id = Auth::user()->id;
            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'news/',
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
            ->route('backadmin.news.edit', $n->id)
            ->withSuccess('Berita berhasil dibuat');
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
        if (!Gate::allows('view news')) {
            abort(401);
        }
        $n = News::find($id);
        return view('backadmin.news.form', [
            'title' => 'Edit Berita',
            'news' => $n,
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
        if (!Gate::allows('store news')) {
            abort(401);
        }
        $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', 'unique:news,id,'.$id],
            'image' => ['image', 'mimes: jpeg,jpg,png', 'max:10240'],
            'category_id' => ['required'],
            'content' => ['required'],
            'excerpt' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = News::find($id);
            if(in_array(Auth::user()->type, ['ncp', 'superadmin'])) {
                $n->fill($request->only(['title', 'slug', 'content', 'status', 'published_at', 'excerpt',  'category_id']));
            } else {
                $n->fill($request->only(['title', 'slug', 'content', 'published_at', 'excerpt',  'category_id']));
            }

            $n->save();
            if($request->has('image')){
                $name = '';
                $res = UploadFile::uploadImage(
                    $request->file('image'),
                    'news/',
                    'A-'.Carbon::now()->format('Hisv'),
                    null,
                    function($new_name) use (&$name){
                        $name = $new_name;
                    }
                );
                if($res !== "All Process success"){
                    throw new Exception($res);
                }
                File::delete(storage_path('app/public/news/'.$n->image));
                File::delete(storage_path('app/public/news/thumb_'.$n->image));
                
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
            ->route('backadmin.news.edit', $n->id)
            ->withSuccess('Berita berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete news')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $n = News::find($id);
            
            if($n->image != null){
                File::delete(storage_path('app/public/news/'.$n->image));
                File::delete(storage_path('app/public/news/thumb_'.$n->image));
            }
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.news.index')
                ->withSuccess('Berita berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
