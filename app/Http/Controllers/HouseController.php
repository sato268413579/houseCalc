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
     * データ登録
     */
    public function register(Request $request){
        $model = new MonthHouseCalc();
        $toMonthData = $model->getToMonthData($request->input('toMonth'));
        //更新
        if($toMonthData){
            $toMonthData['month'] = $request->input('toMonth');
            $toMonthData['yatin'] = $request->input('yatin', 0) ?? 0;
            $toMonthData['eat'] = $request->input('syokuhi', 0) ?? 0;
            $toMonthData['gasu'] = $request->input('gasudai', 0) ?? 0;
            $toMonthData['denki'] = $request->input('denkidai', 0) ?? 0;
            $toMonthData['suidou'] = $request->input('suidoudai', 0) ?? 0;
            $toMonthData['tuushin'] = $request->input('tuusinhi', 0) ?? 0;
            $toMonthData['loan'] = $request->input('loandai', 0) ?? 0;
            $toMonthData['otherSum'] = $request->input('otherSum', 0) ?? 0;
            $toMonthData['comment'] = $request->input('comment', '') ?? '';
            $ret = $model->register($toMonthData);
            $message = '更新が完了しました。';
        //追加
        }else{
            $model['month'] = $request->input('toMonth');
            $model['yatin'] = $request->input('yatin', 0) ?? 0;
            $model['eat'] = $request->input('syokuhi', 0) ?? 0;
            $model['gasu'] = $request->input('gasudai', 0) ?? 0;
            $model['denki'] = $request->input('denkidai', 0) ?? 0;
            $model['suidou'] = $request->input('suidoudai', 0) ?? 0;
            $model['tuushin'] = $request->input('tuusinhi', 0) ?? 0;
            $model['loan'] = $request->input('loandai', 0) ?? 0;
            $model['otherSum'] = $request->input('otherSum', 0) ?? 0;
            $model['comment'] = $request->input('comment', '') ?? '';
            $ret = $model->register($model);
            $message = '登録が完了しました。';
        }

        return redirect()
            ->route('house.index')
            ->with(['message' => $message]);
    }
    
    /**
     * プルダウンで選択した月間データを取得・表示
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
