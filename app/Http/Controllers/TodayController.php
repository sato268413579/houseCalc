<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EatHistory;
use App\Models\ImagesModel;
use Illuminate\Support\Facades\Storage;

class TodayController extends Controller
{
    public function view(){
        return view('today');
    }

    public function todayRegister(Request $request){
        // $postData = json_decode($request->getContent(), true);

        // $eatHistory = new EatHistory();
        // $maxOiban = $eatHistory->getMaxOiban(date('Y-m',strtotime($postData['today'])), $postData['today']);
    
        // $eatHistory['month'] = date('Y-m',strtotime($postData['today']));
        // $eatHistory['day'] = $postData['today'];
        // $eatHistory['oiban'] = $maxOiban + 1 ?? 1;
        // $eatHistory['pay'] = $postData['pay'];
        // $eatHistory['type'] = $postData['type'];
        
        // dd($request->image->storeAs('public', $request->image->getClientOriginalName()));

        
        

        $eatHistory = new EatHistory();
        $maxOiban = $eatHistory->getMaxOiban(date('Y-m',strtotime($request->today)), $request->today);
    
        $eatHistory['month'] = date('Y-m',strtotime($request->today));
        $eatHistory['day'] = $request->today;
        $eatHistory['oiban'] = $maxOiban + 1 ?? 1;
        $eatHistory['pay'] = $request->pay;
        $eatHistory['type'] = $request->type;

        $files = str_replace('public/' . $eatHistory['month'] . '/', '', Storage::files('public/' . $eatHistory['month']));
        
        $maxFileName = preg_grep("!". str_replace('/', '-', $request->today) . "!", $files);

        //日付形式統一
        $todayFolderName = str_replace('/', '-', $request->today);
        $todayFolderName = date('Y-m-d', strtotime($todayFolderName));

        //ファイル保存
        $request->image->storeAs('public/' . $eatHistory['month'], $todayFolderName . '_' . strval(count($maxFileName) + 1) . '.jpeg');

        $ret = $eatHistory->register($eatHistory);

        return response()->json([
            'result' => $ret
        ]);
    }
}
