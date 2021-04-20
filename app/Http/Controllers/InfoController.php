<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoModel;

class InfoController extends Controller
{
    public function view(){
        return view('info');
    }

    public function register(Request $request){
        $postData = json_decode($request->getContent(), true);

        $model = new InfoModel();
        $model['day'] = $postData['day'];
        $model['func'] = $postData['func'];
        $model['detail'] = $postData['detail'];
        $model->register($model, $postData['detail']);

        return response()->json(['json' => $postData]);
    }
}
