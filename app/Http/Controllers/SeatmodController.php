<?php

namespace App\Http\Controllers;

use App\Seatmod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SeatmodController extends Controller
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
        $seatmods = Seatmod::paginate(20);

        return view('seatmods.index')
            ->with('seatmods', $seatmods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Seatmod $seatmod)
    {
        return view('seatmods.create')
            ->with('seatmod', $seatmod)
            ->with('method', 'POST')
            ->with('route', route('admin.seatmods.store', [$seatmod]))
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
            'party_id'    => 'required|exists:parties,id',
            'modifier'    => 'required|numeric',
        ]);

        $seatmod = new Seatmod($request->all());
        $seatmod->save();
        
        return redirect()->route('admin.seatmods.index')->with('messages', [trans('admin/resources.create.status-ok')]);
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
    public function edit(Seatmod $seatmod)
    {
        return view('seatmods.edit')
            ->with('seatmod', $seatmod)
            ->with('method', 'PUT')
            ->with('route', route('admin.seatmods.update', [$seatmod]))
            ->with('submitBtn', trans('admin/resources.update.save'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seatmod $seatmod)
    {
        $request->validate([
            'party_id'    => 'required|exists:parties,id',
            'modifier'    => 'required|numeric',
        ]);

        $seatmod->fill($request->all());
        $seatmod->update();
        
        return redirect()->route('admin.seatmods.index')->with('messages', [trans('admin/resources.update.status-ok' )]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seatmod $seatmod)
    {
        $seatmod->delete();

        return redirect()->route('admin.seatmods.index')->with('messages', [trans('admin/resources.destroy.status-ok')]);
    }
}