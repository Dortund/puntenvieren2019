<?php

namespace App\Http\Controllers;

use App\Multiplier;
use Illuminate\Http\Request;

class MultiplierController extends Controller
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
        $multipliers = Multiplier::paginate(20);

        return view('multipliers.index')
            ->with('multipliers', $multipliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Multiplier $multiplier)
    {
        return view('multipliers.create')
            ->with('multiplier', $multiplier)
            ->with('method', 'POST')
            ->with('route', route('admin.multipliers.store', [$multiplier]))
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
            'product'    => 'required',
            'value'    => 'required|numeric',
        ]);

        $multiplier = new Multiplier($request->all());
        $multiplier->save();
        
        return redirect()->route('admin.multipliers.index')->with('messages', [trans('admin/resources.create.status-ok')]);
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
    public function edit(Multiplier $multiplier)
    {
        return view('multipliers.edit')
            ->with('multiplier', $multiplier)
            ->with('method', 'PUT')
            ->with('route', route('admin.multipliers.update', [$multiplier]))
            ->with('submitBtn', trans('admin/resources.update.save'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multiplier $multiplier)
    {
        $request->validate([
            'product'    => 'required',
            'value'    => 'required|numeric',
        ]);

        $multiplier->fill($request->all());
        $multiplier->update();
        
        return redirect()->route('admin.multipliers.index')->with('messages', [trans('admin/resources.update.status-ok' )]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multiplier $multiplier)
    {
        $multiplier->delete();

        return redirect()->route('admin.multipliers.index')->with('messages', [trans('admin/resources.destroy.status-ok')]);
    }
}