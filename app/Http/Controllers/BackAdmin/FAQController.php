<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use UploadFile;
use Carbon\Carbon;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view faq')) {
            abort(401);
        }
        if($request->ajax()){
            $n = FAQ::all();
            return DataTables::of($n)->addIndexColumn()->make();
        }

        return view('backadmin.faq.index')->with([
            'title' => 'FAQ'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('store faq')) {
            abort(401);
        }
        return view('backadmin.faq.form', [
            'title' => 'Tambah FAQ',
            'faq' => new FAQ,
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
        if (!Gate::allows('store faq')) {
            abort(401);
        }
        $request->validate([
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = FAQ::create($request->only(['question', 'answer']));
            $n->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.faq.edit', $n->id)
            ->withSuccess('FAQ berhasil dibuat');
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
        if (!Gate::allows('view faq')) {
            abort(401);
        }
        $c = FAQ::find($id);
        return view('backadmin.faq.form', [
            'title' => 'Edit FAQ',
            'faq' => $c,
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
        if (!Gate::allows('store faq')) {
            abort(401);
        }
        $request->validate([
            'question' => ['required', 'max:255'],
            'answer' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = FAQ::find($id);
            $n->fill($request->only(['question', 'answer']));
            $n->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.faq.edit', $n->id)
            ->withSuccess('FAQ berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete faq')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $n = FAQ::find($id);
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.faq.index')
                ->withSuccess('FAQ berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
