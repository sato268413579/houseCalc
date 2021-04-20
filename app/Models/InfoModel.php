<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InfoModel extends Model
{
    use HasFactory;

    protected $table = 'info';

    public string $day;
    public string $func;
    public string $detail;

    /**
     * 問い合わせ情報登録処理
     */
    public function register(InfoModel $infoModel, $detailMsg){
        DB::beginTransaction();
        try{
            $infoModel->save();

            Mail::send('mail.tempMail', ['data' => $detailMsg], function($message){
    	        $message->to('aderu6390@gmail.com', 'Test')->subject('【houseCalc】問い合わせ情報');
    	    });
        }
        catch(exception $e){
            DB::rollBack();
        }

        DB::commit();
    }
}
