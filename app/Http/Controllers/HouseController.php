<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;
use App\Models\syunyuMaster;

class HouseController extends Controller
{
    /**
     * 初期表示
     */
    public function view(){

        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData();
        $toMonthData = $toMonthData->toArray();

        $syunyuModel = new syunyuMaster();
        $syunyu = $syunyuModel->getSyunyu();

        return view('houseIndex',compact('toMonthData', 'syunyu'));
    }

    /**
     * 既存データチェック
     */
    public function dataCheck(){
        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData();
        $toMonthData = $toMonthData->toArray();
        $result = 0;

        //データが存在する場合
        if($toMonthData){
            $result = 1;
        }

        return response()->json(['result' => $result]);
    }

    /**
     * データ登録
     */
    public function register(Request $request){
        $postData = json_decode($request->getcontent(), true);
        
        $model = new MonthHouseCalc();
        $toMonthData = $model->getToMonthData();
        //更新
        if($toMonthData){
            $toMonthData['month'] = $postData['month'];
            $toMonthData['yatin'] = $postData['yatin'];
            $toMonthData['eat'] = $postData['syokuhi'];
            $toMonthData['gasu'] = $postData['gasudai'];
            $toMonthData['denki'] = $postData['denkidai'];
            $toMonthData['suidou'] = $postData['suidoudai'];
            $toMonthData['tuushin'] = $postData['tuusinhi'];
            $toMonthData['loan'] = $postData['loandai'];
            $toMonthData['comment'] = $postData['comment'];
            $ret = $model->register($toMonthData);
        //追加
        }else{
            $model->month = $postData['month'];
            $model->yatin = $postData['yatin'];
            $model->eat = $postData['syokuhi'];
            $model->gasu = $postData['gasudai'];
            $model->denki = $postData['denkidai'];
            $model->suidou = $postData['suidoudai'];
            $model->tuushin = $postData['tuusinhi'];
            $model->loan = $postData['loandai'];
            $model->comment = $postData['comment'];
            $ret = $model->register($model);
        }

        return response()->json([
            'result' => $ret
        ]);
    }
}
