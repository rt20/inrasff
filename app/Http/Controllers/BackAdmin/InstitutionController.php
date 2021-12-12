<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\DownStreamNotification;
use App\Models\UpStreamNotification;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
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
        if (!Gate::allows('view institution')) {
            abort(401);
        }
        if($request->ajax()){
            $institution = Institution::query();
            if(auth()->user()->type!=='superadmin'){
                switch (auth()->user()->type) {
                    case 'ncp':
                        $institution = $institution->where('type', 'ccp');
                        break;
                    case 'ccp':
                        $institution = $institution->where('type', 'lccp')
                                            ->where('parent_id', auth()->user()->institution_id);
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
            return DataTables::of($institution->get())->addIndexColumn()->make();
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
        if (!Gate::allows('store institution')) {
            abort(401);
        }
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
        if (!Gate::allows('store institution')) {
            abort(401);
        }
        $request->validate([
            'name' => ['required', 'max:255', 'unique:institutions'],
            'type' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $institution = Institution::make($request->only(['name', 'type', 'parent_id']));
            if(auth()->user()->type==='ccp'){
                $institution->parent_id = auth()->user()->institution_id;
            }
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
        if (!Gate::allows('view institution')) {
            abort(401);
        }

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
        if (!Gate::allows('store institution')) {
            abort(401);
        }

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
        if (!Gate::allows('delete institution')) {
            abort(401);
        }
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
        if($request->user->institution_id!==null){
            $query = $query->where('parent_id', $request->user->institution_id);
        }
        $query = $query->where('is_active', true);
        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  Institution::select(['id', 'name', 'parent_id', 'type'])
            ->where('id', $request->id);

        return $query->first();
    }

    function getS2OptionsForFollowUp(Request $request){
        try {
            $term = $request->q;
            $for_notification = $request->for_notification;
            $id_notification = $request->id_notification;    
            // return $request->for_notification;
            // return $request->all();
            
            if($for_notification==null || $id_notification==null)
                throw new Exception("Empty Notification Parameter", 1);
                
            $notification;
            switch ($for_notification) {
                case 'downstream':
                    $notification = DownStreamNotification::find($id_notification);
                    $ins = $notification->downstreamInstitution->pluck('institution_id');
                    break;
                case 'upstream':
                    $notification = UpStreamNotification::find($id_notification);
                    $ins = $notification->upstreamInstitution->pluck('institution_id');
                    break;
                default:
                    throw new Exception("For Notification not Defined", 1);                    
                    break;
            }
            
            
            
            
            $query = Institution::select(['id','name', 'type'])
                ->where(function($q) use ($term, $ins) {
                    $q->where('name', 'like', '%' . $term . '%');
                })
                ->whereIn('id', $ins);

            if($request->has('only_ccp') & $request->only_ccp === 'true'){
                $query = $query->where('type', 'ccp');
            }
            if($request->has('only_lccp') & $request->only_lccp === 'true'){
                $query = $query->where('type', 'lccp');
            }
            
            return $query->get();

        } catch (Exception $e) {
            return $e->getMessage();
            return [];
        }
    }

    public function toggleActive(Institution $institution)
    {
        try {
            $institution->is_active = !$institution->is_active;
            $institution->save();
            return redirect()->route('backadmin.institutions.edit', $institution->id)
                ->withSuccess('Lembaga berhasil ' . (($institution->is_active) ? 'diaktifkan': 'dinonaktifkan'));
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
