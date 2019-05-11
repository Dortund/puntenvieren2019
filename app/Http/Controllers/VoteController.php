<?php

namespace App\Http\Controllers;

use App\Motion;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

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
        
        $this->middleware('can:has-party')->only([
            'currentVote',
            'storeCurrent',
        ]);
    }
    
    public function currentVote() {
        $motion = Motion::currentMotion();
        
        if (isset($motion)) {
            $vote = Vote::where([
                ['motion_id', '=', $motion->id],
                ['party_id', '=', Auth::user()->party->id]
            ])->first();
            
            return view('votes.currentVote')
            ->with('vote', $vote)
            ->with('motion', $motion);
        }
        else {
            return view('votes.currentVote');
        }
        
    }
    
    public function changeVote() {
        $motion = Motion::currentMotion();
        
        if (isset($motion)) {
            $vote = Vote::where([
                ['motion_id', '=', $motion->id],
                ['party_id', '=', Auth::user()->party->id]
            ])->first();
            
            return view('votes.partyVote')
            ->with('vote', $vote)
            ->with('motion', $motion)
            ->with('method', 'POST')
            ->with('route', route('storeCurrent', [$vote]))
            ->with('submitBtn', 'Stem opslaan');
        }
        else {
            return redirect()->route('currentVote');
        }
    }
    
    public function storeCurrent(Request $request, Vote $vote) {
        $motion = Motion::currentMotion();
        $request->validate([
            'vote_value'    => 'required',
        ]);
        
        if (!isset($motion) || $motion->id != $request->input('motion_id')) {
            return redirect()->route('currentVote')->with('messages', ['Voor deze motie werd niet meer gestemd']);
        }
        
        $origVote = Vote::where([
            ['motion_id', '=', $motion->id],
            ['party_id', '=', Auth::user()->party->id]
        ])->first();
        
        if (isset($origVote)) {
           $origVote->vote_value = $request->input('vote_value');
           $origVote->save();
        }
        else {
            $vote->motion_id = $motion->id;
            $vote->party_id = Auth::user()->party->id;
            $vote->vote_value = $request->input('vote_value');
            $vote->save();
        }
        
        return redirect()->route('currentVote')->with('messages', ['Stem succesvol opgeslagen']);
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