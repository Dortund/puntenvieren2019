<?php

namespace App\Http\Controllers;

use App\Motion;
use App\Party;
use App\Result;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function getSeatData() {
        $parties = Party::all()->toArray();
        
        $motion = Motion::currentMotion();
        if (isset($motion)) {
            $motion = $motion->toArray();
        }
        
        $prevMotion = Motion::previousMotion();
        $results = null;
        if (isset($prevMotion)) {
            $results = Result::where('motion_id', '=', $prevMotion->id)->orderBy('seats', 'desc')->get();
            $results = $results->toArray();
            
            $prevMotion = $prevMotion->toArray();
        }
        
        
        $res = [
            'motion' => $motion,
            'prevMotion' => $prevMotion,
            'results' => $results,
            'parties' => $parties,
        ];
        
        //return response()->json(json_decode($data));
        //return response()->json(json_decode(Party::all()->toJson()));
        return response()->json($res);
    }
}
