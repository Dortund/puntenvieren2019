<?php

namespace App\Http\Controllers;

use App\Motion;
use App\Party;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function getSeatData() {
        $seats = mt_rand(0, 750);
        $val = 750 - $seats;
        $seats2 = mt_rand(0, $val);
        $data = '[
                    {
                        "id": "pp",
                        "seats": ' . $seats . ',
                        "colour":"#00FF00"
                    },
                    {
                        "id": "df",
                        "seats": ' . $seats2 . ',
                        "colour":"#0000FF"
                    },
                    {
                        "id": "sf",
                        "seats": ' . ($val - $seats2) . ',
                        "colour":"#FF0000"
                    }
                ]';
        
        //dd(Party::all()->toArray());
        
        $parties = Party::all()->toArray();
        
        $motion = Motion::currentMotion();
        
        if (isset($motion)) {
            $motion = $motion->toArray();
        }
        
        $res = ['motion' => $motion,
                'parties' => $parties,
        ];
        
        //return response()->json(json_decode($data));
        //return response()->json(json_decode(Party::all()->toJson()));
        return response()->json($res);
    }
}
