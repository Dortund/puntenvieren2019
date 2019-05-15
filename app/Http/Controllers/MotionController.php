<?php

namespace App\Http\Controllers;

use App\Motion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MotionController extends Controller
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
        $motions = Motion::orderBy('time_of_vote', 'desc')->paginate(20);
        
        return view('motions.index')
        ->with('motions', $motions);
    }
    
    private function convertDate($input) {
        $parts = explode(' ', $input);
        return implode('T', $parts);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Motion $motion)
    {
        $motion->time_of_vote = $this->convertDate(Carbon::now()->format('Y-m-d H:m'));
        return view('motions.create')
        ->with('motion', $motion)
        ->with('method', 'POST')
        ->with('route', route('admin.motions.store', [$motion]))
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
            'text'    => 'required',
            'time_of_vote'    => 'required',
            'vote_value_type' => 'required|exists:vote_value_types,id',
        ]);
        
        $motion = new Motion($request->all());
        $motion->save();
        
        return redirect()->route('admin.motions.index')->with('messages', [trans('admin/resources.create.status-ok')]);
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
    public function edit(Motion $motion)
    {
        $motion->time_of_vote = $this->convertDate($motion->time_of_vote);
        return view('motions.edit')
        ->with('motion', $motion)
        ->with('method', 'PUT')
        ->with('route', route('admin.motions.update', [$motion]))
        ->with('submitBtn', trans('admin/resources.update.save'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motion $motion)
    {
        $request->validate([
            'text'    => 'required',
            'time_of_vote'    => 'required',
            'vote_value_type' => 'required|exists:vote_value_types,id',
        ]);
        
        $motion->fill($request->all());
        $motion->update();
        
        return redirect()->route('admin.motions.index')->with('messages', [trans('admin/resources.update.status-ok' )]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motion $motion)
    {
        $motion->delete();
        
        return redirect()->route('admin.motions.index')->with('messages', [trans('admin/resources.destroy.status-ok')]);
    }
}