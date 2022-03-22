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
        $eatHistory['type'] = $request->gender;
        $eatHistory['othercomment'] = $request->otherComment ?? '';
        if ($request->gender === '1') {
            $files = str_replace('public/' . $eatHistory['month'] . '/', '', Storage::files('public/' . $eatHistory['month']));
            
            $maxFileName = preg_grep("!". str_replace('/', '-', $request->today) . "!", $files);

            //日付形式統一
            $todayFolderName = str_replace('/', '-', $request->today);
            $todayFolderName = date('Y-m-d', strtotime($todayFolderName));

            //ファイルパス
            $filePath = 'public/' . $eatHistory['month'];

            //ファイル名
            $fileName = $todayFolderName . '_' . $eatHistory['oiban'] . '.jpeg';

            //ファイル保存
            // Storage::put($filePath, $fileName);
            $request->image->storeAs($filePath, $fileName);
            if(Storage::disk('local')->exists($filePath . '/' . $fileName)){
                Storage::disk('copy')->put($filePath . '/' . $fileName, Storage::disk('local')->get($filePath . '/' . $fileName));
            }
        }

        $ret = $eatHistory->register($eatHistory);

        return redirect()
            ->route('today.index')
            ->with(['message' => $request->today . ' で正常に登録されました。']);
    }
}
