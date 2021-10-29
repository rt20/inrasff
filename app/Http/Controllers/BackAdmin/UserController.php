<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $user = User::query();
            $user = $user->where('username', '!=', 'superadmin');
            return DataTables::of($user)->make();
        }

        return view('backadmin.user.index')->with([
            'title' => 'Pengguna'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backadmin.user.form', [
            'title' => 'Tambah Pengguna',
            'user' => new User,
            'user_types' => User::getCreateableUserTypes(),
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
            'fullname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'type' => ['required', 'max:255'],
            'email' => ['required', 'email','max:255', 'unique:users'],
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password|min:6',
        ]);

        try {
            DB::beginTransaction();
            $user = User::make($request->only([
                'username',
                'fullname',
                'type',
                'email',
                'password'
            ]));
            $user->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.users.edit', $user->id)
            ->withSuccess('Pengguna berhasil dibuat');
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
    public function edit(User $user)
    {
        return view('backadmin.user.form', [
            'title' => $user->fullname,
            'user' => $user,
            'user_types' => User::getCreateableUserTypes(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user);
        $request->validate([
            'fullname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,id,'.$user->id],
            'type' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,id,'.$user->id],          
        ]);
        // dd("s");
        try {
            DB::beginTransaction();
            $user->fill($request->only([
                'username',
                'fullname',
                'type',
                'email',
            ]));
            $user->save();
            DB::commit();
            
        } catch (Exception $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->withError($e->getMessage());

        }
        return redirect()
            ->route('backadmin.users.edit', $user->id)
            ->withSuccess('Pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();

            return redirect()
                ->route('backadmin.users.index')
                ->withSuccess('Pengguna berhasil dihapus');

        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Get select2 options
     */
    function getS2Options(Request $request) {
        $term = $request->q;
        $query = User::query()
            ->where(function($q) use ($term) {
                $q->where('fullname', 'like', '%' . $term . '%');
            });

        return $query->get();
    }

    function getS2Init(Request $request){
        $query =  User::select(['id', 'fullname'])
            ->where('id', $request->id);

        return $query->first();
    }
}
