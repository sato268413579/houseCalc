<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EatHistory;

class TodayController extends Controller
{
    public function view(){
        return view('today');
    }

    public function todayRegister(Request $request){
        $postData = json_decode($request->getContent(), true);

        $eatHistory = new EatHistory();
        $maxOiban = $eatHistory->getMaxOiban(date('Y-m',strtotime($postData['today'])), $postData['today']);
    
        $eatHistory['month'] = date('Y-m',strtotime($postData['today']));
        $eatHistory['day'] = $postData['today'];
        $eatHistory['oiban'] = $maxOiban + 1 ?? 1;
        $eatHistory['pay'] = $postData['pay'];
        $eatHistory['type'] = $postData['type'];
        $ret = $eatHistory->register($eatHistory);

        return response()->json([
            'result' => $ret
        ]);
    }
}
