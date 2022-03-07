<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthHouseCalc;
use App\Models\EatHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BeforeMonthController extends Controller
{
    public function view(){
        $model = new MonthHouseCalc();
        $allMonths = $model->getAllMonth();
        return view('beforeMonth', compact('allMonths'));
    }

    public function getBeforeData(Request $request){
        $postData = json_decode($request->getcontent(), true);

        switch ($postData['type']) {
            case 'registerDay':
                $model = new EatHistory();

                $month = str_replace('/', '-', $postData['toMonth']);

                $data = $model->getDayData($month);

                $files = str_replace('public/' . $month . '/', '', Storage::disk('copy')->files('public/' . $month));
                
                for($i = 0; $i < count($data); $i++){
                    $data[$i]['day'] = str_replace('/', '-', $data[$i]['day']);
                    $data[$i]['oiban'] = $data[$i]['oiban'];
                    
                    //ファイル名の日付形式が合わないため日付形式を合わせる (例：2021-08-3 → 2021-08-03)
                    $data[$i]['day'] = date('Y-m-d', strtotime($data[$i]['day']));

                    //ファイル数分チェック
                    for($j = 0; $j < count($files); $j++){

                        $nonExtension = substr($files[$j], 0, strcspn($files[$j], '_'));
                        $day = date('Y-m-d', strtotime($data[$i]['day']));
                        if($files[$j] == $day . '_' . $data[$i]['oiban'] . '.jpeg'){
                            $monthFolder = date('Y-m', strtotime($nonExtension));
                            $data[$i]['image'] = $monthFolder . '/' . $files[$j];
                        }
                    }
                }
                break;
            case 'sum':
                $model = new MonthHouseCalc();
                $data = $model->getDataMonth($postData['toMonth']);
                break;
        }

        return response()->json(['data' => $data]);
    }


    public function dayDelete(Request $request)
    {
        $postData = json_decode($request->getContent(), true);
        
        $dayPipeOiban = explode('|', $postData['dayPipeOiban']);
        
        $fileNameToDay = str_replace('|', '_', $postData['dayPipeOiban']);
        $folderName = date('Y-m', strtotime($dayPipeOiban[0]));
        
        $filePath = 'public/' . $folderName . '/' . $fileNameToDay . '.jpeg';
        Storage::disk('copy')->delete($filePath);

        $month = date('Y-m', strtotime($dayPipeOiban[0]));
        $day = date('Y/m/j', strtotime($dayPipeOiban[0]));
        $oiban = $dayPipeOiban[1];
        $eatHistories = new EatHistory();

        $result = $eatHistories->dayDelete($month, $day, $oiban);

        return response()->json(['result' => $result]);
    }
}
