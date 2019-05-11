<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:is-admin')->only([
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]);
    }
    
    public function currentVote() {
        dd(date('m/d/Y h:i:s a', time()));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Vote::paginate(20);
        
        return view('votes.index')
        ->with('votes', $votes);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vote $vote)
    {
        return view('votes.create')
        ->with('vote', $vote)
        ->with('method', 'POST')
        ->with('route', route('admin.votes.store', [$vote]))
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
            'party_id'    => 'required|exists:parties',
            'motion_id'    => 'required|exists:motions',
            'vote_value'    => 'required',
        ]);
        
        $vote = new Vote($request->all());
        $vote->save();
        
        return redirect()->route('admin.votes.index')->with('messages', [trans('admin/resources.create.status-ok')]);
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
    public function edit(Vote $vote)
    {
        return view('votes.edit')
        ->with('vote', $vote)
        ->with('method', 'PUT')
        ->with('route', route('admin.votes.update', [$vote]))
        ->with('submitBtn', trans('admin/resources.update.save'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        $request->validate([
            'party_id'    => 'required|exists:parties',
            'motion_id'    => 'required|exists:motions',
            'vote_value'    => 'required',
        ]);
        
        $vote->fill($request->all());
        $user->update();
        
        return redirect()->route('admin.votes.index')->with('messages', [trans('admin/resources.update.status-ok' )]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();
        
        return redirect()->route('admin.votes.index')->with('messages', [trans('admin/resources.destroy.status-ok')]);
    }
}