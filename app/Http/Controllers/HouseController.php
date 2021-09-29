<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;
use App\Models\syunyuMaster;
use App\Models\EatHistory;

class HouseController extends Controller
{
    /**
     * 初期表示
     */
    public function view(Request $request){
        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData(date('Y/m')) ?? new MonthHouseCalc();
        $toMonthData = $toMonthData->toArray();
        
        $syunyuModel = new syunyuMaster();
        $syunyu = $syunyuModel->getSyunyu();

        $toMonthEat = new EatHistory();
        $sumEat = $toMonthEat->getToMonthSumPay(date('Y-m'));
        $sumOther = $toMonthEat->getToMonthOtherSumPay(date('Y-m'));

        return view('houseIndex',compact('toMonthData', 'syunyu', 'sumEat', 'sumOther'));
    }

    /**
     * 既存データチェック
     */
    public function dataCheck(Request $request){
        $postData = json_decode($request->getContent(), true);

        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData($postData['toMonth'] ?? today()) ?? new MonthHouseCalc();
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
        
        // $rules = [
        //     'admin_code' => ['required', 'integer', 'unique:admin'],
        //     'role' => ['size:1'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed']
        // ];
        // $this->validate($request, $rules);
        
        $postData = json_decode($request->getcontent(), true);
        
        $model = new MonthHouseCalc();
        $toMonthData = $model->getToMonthData($postData['month']);
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
            $toMonthData['otherSum'] = $postData['otherSum'];
            $toMonthData['comment'] = $postData['comment'];
            $ret = $model->register($toMonthData);
        //追加
        }else{
            $model['month'] = $postData['month'];
            $model['yatin'] = $postData['yatin'];
            $model['eat'] = $postData['syokuhi'];
            $model['gasu'] = $postData['gasudai'];
            $model['denki'] = $postData['denkidai'];
            $model['suidou'] = $postData['suidoudai'];
            $model['tuushin'] = $postData['tuusinhi'];
            $model['loan'] = $postData['loandai'];
            $model['otherSum'] = $postData['otherSum'];
            $model['comment'] = $postData['comment'];
            $ret = $model->register($model);
        }

        return response()->json([
            'result' => $ret
        ]);
    }
    
    /**
     * 初期表示
     */
    public function getAjaxData(Request $request){
        $postData = json_decode($request->getContent(), true);

        $month = new MonthHouseCalc();
        $toMonthData = $month->getToMonthData($postData['toMonth'] ?? today()) ?? new MonthHouseCalc();
        $toMonthData = $toMonthData->toArray();

        $syunyuModel = new syunyuMaster();
        $syunyu = $syunyuModel->getSyunyu();

        $toMonthEat = new EatHistory();
        $sumEat = $toMonthEat->getToMonthSumPay(date('Y-m', strtotime($postData['toMonth'] . '/01')) ?? date('Y-m'));
        $sumOther = $toMonthEat->getToMonthOtherSumPay(date('Y-m', strtotime($postData['toMonth'] . '/01')) ?? date('Y-m'));

        return response()->json([
            'data' => $toMonthData,
            'eat' => $sumEat,
            'sumOther' => $sumOther
        ]);
    }
}
