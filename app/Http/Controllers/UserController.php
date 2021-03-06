<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:is-admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('users.create')
            ->with('user', $user)
            ->with('method', 'POST')
            ->with('route', route('admin.users.store', [$user]))
            ->with('submitBtn', trans('admin/users.create.save'));
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
            'username'    => 'required|unique:users|max:45',
            'password'    => 'required|max:191',
        ]);

        $user = new User($request->all());
        $user->password = Hash::make($request->input('password'));
        $user->is_admin = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('messages', [trans('admin/users.create.status-ok')]);
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
        return view('users.edit')
            ->with('user', $user)
            ->with('method', 'PUT')
            ->with('route', route('admin.users.update', [$user]))
            ->with('submitBtn', trans('admin/users.update.save'));
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
        $request->validate([
            'username'    => 'required|unique:users,username,' . $user->id . '|max:45',
            'password'    => 'required|max:191',
        ]);

        $user->fill($request->all());
        $user->password = Hash::make($request->input('password'));
        $user->update();
        
        return redirect()->route('admin.users.index')->with('messages', [trans('admin/users.update.status-ok' )]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //$share = Share::find($id);
        //$share->delete();
        $user->delete();

        return redirect()->route('admin.users.index')->with('messages', [trans('admin/users.destroy.status-ok')]);
    }
}