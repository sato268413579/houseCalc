<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;
use App\Models\EatHistory;

class BeforeMonthController extends Controller
{
    public function view(){
        return view('beforeMonth');
    }

    public function getBeforeData(Request $request){
        $postData = json_decode($request->getcontent(), true);

        dd($postData);
        switch ($postData['type']) {
            case 'registerDay':
                $model = new EatHistory();

                $month = str_replace('/', '-', $postData['toMonth']);

                $data = $model->getDayData($month);
                break;
            case 'sum':
                $model = new MonthHouseCalc();
                $data = $model->getDataMonth($postData['toMonth']);
                break;
            }

        return response()->json(['data' => $data]);
    }
}
