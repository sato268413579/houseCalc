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
        $model['day'] = $request->input('day');
        $model['func'] = $request->input('func');
        $model['detail'] = $request->input('detail');
        $model->registerToMailSend($model, $request->input('detail'));

        return redirect()
            ->route('info.index');
    }
}
