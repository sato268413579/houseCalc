<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;

class HouseController extends Controller
{
    public function view(){

        $month = new MonthHouseCalc();
        $monthData = $month->getData();

        return view('houseIndex',compact('monthData'));
    }
}
