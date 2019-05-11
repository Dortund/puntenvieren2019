<?php

namespace App\Http\Controllers;

use App\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
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
        $parties = Party::paginate(20);
        
        return view('parties.index')
        ->with('parties', $parties);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Party $party)
    {
        return view('parties.create')
        ->with('party', $party)
        ->with('method', 'POST')
        ->with('route', route('admin.parties.store', [$party]))
        ->with('submitBtn', trans('admin/resources.create.save'));
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
            'name'    => 'required|unique:users|max:45',
            'colour'    => 'required|max:191',
            'avatar'    => 'required|max:191',
        ]);
        
        $party = new Party($request->all());
        $party->save();
        
        return redirect()->route('admin.parties.index')->with('messages', [trans('admin/resources.create.status-ok')]);
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
    public function edit(Party $party)
    {
        return view('parties.edit')
        ->with('party', $party)
        ->with('method', 'PUT')
        ->with('route', route('admin.parties.update', [$party]))
        ->with('submitBtn', trans('admin/parties.update.save'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Party $party)
    {
        $request->validate([
            'name'    => 'required|unique:users,username,' . $party->id . '|max:45',
        ]);
        
        $party->fill($request->all());
        
        // TODO Setup proper image handling
        if ($request->hasFile('avatar')) {
            $party->avatar = "/";
        }
        
        $party->update();
        
        return redirect()->route('admin.parties.index')->with('messages', [trans('admin/resources.update.status-ok' )]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        $party->delete();
        
        return redirect()->route('admin.parties.index')->with('messages', [trans('admin/resources.destroy.status-ok')]);
    }
}