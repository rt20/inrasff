<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use Carbon\Carbon;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){
            $institution = Institution::all();
            
            return DataTables::of($institution)->make();
        }

        return view('backadmin.institution.index')->with([
            'title' => 'Lembaga'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.institution.form', [
            'title' => 'Tambah Lembaga',
            'institution' => new Institution,
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
            'name' => ['required', 'max:255', 'unique:institutions'],
            'type' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $institution = Institution::make($request->only(['name', 'type', 'parent_id']));

            $institution->save();
            
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.institutions.edit', $institution->id)
            ->withSuccess('Lembaga berhasil dibuat');
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
    public function edit(Institution $institution)
    {
        // $institution = Institution::find($id);
        return view('backadmin.institution.form', [
            'title' => $institution->name,
            'institution' => $institution,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        // dd($institution);
        $request->validate([
            'name' => ['required', 'max:255', 'unique:institutions,id,'.$institution->id],
            'type' => ['required'],
            // 'category_id' => ['required'],
        ]);
        try {
            // dd($request->all());
            DB::beginTransaction();
            // $institution = Institution::find($id);
            $institution->fill($request->only(
                [
                    'name', 
                    // 'type', 
                    // 'parent_id'
                ]));
            // if(!$request->has('parent_id'))
            //     $institution->parent_id = null;
            $institution->update();
            
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.institutions.edit', $institution->id)
            ->withSuccess('Lembaga berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        try {
            DB::beginTransaction();            
            $institution->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.institutions.index')
                ->withSuccess('Lembaga berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    function getS2Options(Request $request) {
        $term = $request->q;
        $query = Institution::select(['id','name', 'parent_id', 'type'])
            ->where(function($q) use ($term) {
                $q->where('name', 'like', '%' . $term . '%');
            });
        if($request->has('only_ccp') & $request->only_ccp === 'true'){
            $query = $query->where('type', 'ccp');
        }
        if($request->has('only_lccp') & $request->only_lccp === 'true'){
            $query = $query->where('type', 'lccp');
        }
        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  Institution::select(['id', 'name', 'parent_id', 'type'])
            ->where('id', $request->id);

        return $query->first();
    }
}
