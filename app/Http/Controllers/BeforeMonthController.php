<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;

class BeforeMonthController extends Controller
{
    public function view(){
        return view('beforeMonth');
    }

    public function getBeforeData(Request $request){
        $postData = json_decode($request->getcontent(), true);

        $model = new MonthHouseCalc();
        $data = $model->getDataMonth($postData['toMonth']);

        return response()->json(['data' => $data]);
    }
}
