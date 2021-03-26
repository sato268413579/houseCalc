<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;

class HouseController extends Controller
{
    public function view(){

        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData();
        dd($toMonthData);
        return view('houseIndex',compact('toMonthData'));
    }
}
