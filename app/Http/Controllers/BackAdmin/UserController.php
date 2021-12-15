<?php

namespace App\Http\Controllers\BackAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('view user')) {
            abort(401);
        }

        if($request->ajax()){
            $user = User::query()->with('institution');
            $user = $user->where('username', '!=', 'superadmin');
            if ($request->has('filter_type') && $request->filter_type != 'all') {
                $user = $user->where('type', $request->filter_type);
            }
            if(auth()->user()->type!=='superadmin'){
                switch (auth()->user()->type) {
                    case 'ncp':
                        $user = $user->where('type', 'ccp');
                        break;
                    case 'ccp':
                        $user = $user->where('type', 'lccp');
                            
                        # code...
                        break;
                    default:
                        # code...
                        break;
                }
            }
            return DataTables::of($user->get())->addIndexColumn()->make();
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
        if (!Gate::allows('store user')) {
            abort(401);
        }
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
        if (!Gate::allows('store user')) {
            abort(401);
        }
        $request->validate([
            'fullname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'type' => ['required', 'max:255'],
            'email' => ['required', 'email','max:255', 'unique:users'],
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password|min:6',

            'type' => ['required'],
            'institution_id' => ['required_if:type,ccp,lccp'],

            'responsible_name' => ['required', 'max:255'],
            'responsible_phone' => ['required', 'max:15'],
            'responsible_address' => ['required'],
        ]);

        try {
            DB::beginTransaction();
            $user = User::make($request->only([
                'username',
                'fullname',
                'type',
                'institution_id',
                'email',
                'responsible_name',
                'responsible_phone',
                'responsible_address',
            ]));
            $user->password = bcrypt($request->password);
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
        if (!Gate::allows('view user')) {
            abort(401);
        }
        
        if(in_array(auth()->user()->type, ['ccp'])){
            if($user->type!=='lccp'){
                abort(401);    
            }
            if($user->institution->parent_id != auth()->user()->institution->id){
                abort(401);
            }
        }elseif(in_array(auth()->user()->type, ['ncp'])){
            if($user->type!=='ccp'){
                abort(401);    
            }
        }
        $user->institution = $user->institution;
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
        if (!Gate::allows('store user')) {
            abort(401);
        }
        $request->validate([
            'fullname' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,id,'.$user->id],
            'type' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,id,'.$user->id],          

            'type' => ['required'],
            'institution_id' => ['required_if:type,ccp,lccp'],

            'responsible_name' => ['required', 'max:255'],
            'responsible_phone' => ['required', 'max:15'],
            'responsible_address' => ['required'],
        ]);
        // dd("s");
        try {
            DB::beginTransaction();
            $user->fill($request->only([
                'username',
                'fullname',
                'type',
                'institution_id',
                'email',
                'responsible_name',
                'responsible_phone',
                'responsible_address',
            ]));
            if($user->type === 'ncp')
                $user->institution_id = null;
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
        if (!Gate::allows('delete user')) {
            abort(401);
        }
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

    public function toggleActive(User $user)
    {
        try {
            $user->is_active = !$user->is_active;
            $user->save();
            return redirect()->route('backadmin.users.edit', $user->id)
                ->withSuccess('User berhasil ' . (($user->is_active) ? 'diaktifkan': 'dinonaktifkan'));
        } catch (Exception $e) {
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
