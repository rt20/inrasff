<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

use UploadFile;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $n = Category::all();
            return DataTables::of($n)->make();
        }

        return view('backadmin.category.index')->with([
            'title' => 'Kategori Berita'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.category.form', [
            'title' => 'Tambah Kategori Berita',
            'category' => new Category,
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
            'name' => ['required', 'max:255'],
            // 'category_id' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = Category::create($request->only(['name', 'description']));
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.categories.edit', $n->id)
            ->withSuccess('Kategori berhasil dibuat');
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
        $c = Category::find($id);
        return view('backadmin.category.form', [
            'title' => 'Edit Kategori Berita',
            'category' => $c,
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
            'name' => ['required', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $n = Category::find($id);
            $n->fill($request->only(['name', 'description']));
            $n->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.categories.edit', $n->id)
            ->withSuccess('Kategori berhasil diubah');
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
            $n = Category::find($id);
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.categories.index')
                ->withSuccess('Kategori berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    function getS2Options(Request $request) {
        $term = $request->q;
        $query = Category::select(['id','name'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%');
            });
        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  Category::select(['id', 'name'])
            ->where('id', $request->id);

        return $query->first();
    }
}
