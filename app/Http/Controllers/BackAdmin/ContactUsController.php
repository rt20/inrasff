<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use UploadFile;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view contact_us')) {
            abort(401);
        }
        if($request->ajax()){
            $n = ContactUs::all();
            return DataTables::of($n)->addIndexColumn()->make();
        }

        return view('backadmin.contactus.index')->with([
            'title' => 'Hubungi Kami'
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
        if (!Gate::allows('view contact_us')) {
            abort(401);
        }
        $c = ContactUs::find($id);
        return view('backadmin.contactus.form', [
            'title' => 'Lihat Hubungi Kami',
            'contactus' => $c,
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
        if (!Gate::allows('store contact_us')) {
            abort(401);
        }
        $request->validate([
            'status' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $n = ContactUs::find($id);
            $n->fill($request->only(['status']));
            $n->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.contactus.edit', $n->id)
            ->withSuccess('Status berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete contact_us')) {
            abort(401);
        }
        try {
            DB::beginTransaction();
            $n = ContactUs::find($id);
            $n->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.contactus.index')
                ->withSuccess('Pesan berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }
}
