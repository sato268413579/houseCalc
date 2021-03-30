<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EatHistory extends Model
{
    use HasFactory;

    protected $table = 'eathistory';

    //fill()を使用する場合はfillableかguardedどちらかを指定しなければいけない
    //fillable = ホワイトリスト的に
    //guarded = ブラックリスト的に
    protected $fillable = ['month', 'day', 'oiban', 'pay'];

    public string $month = '';
    public string $day = '';
    public string $oiban = '';
    public int $pay = 0;

    public function getToMonthSumPay($month){
        return $this::where('month', '=', $month)->sum('pay');
    }

    /**
     * 対象日付の追番MAXを取得
     */
    public function getMaxOiban($month, $today){
        return $this::where('month', '=', $month)->where('day', '=', $today)->max('oiban');
    }

    /**
     * データ登録処理
     */
    public function register(EatHistory $model){
        DB::beginTransaction();
        try{
            DB::transaction(function () {
                
            });
            $model->fill(['month' => $model['month'],
                          'day' => $model['day'],
                          'oiban' => $model['oiban'],
                          'pay' => $model['pay'],
                          'created_at' => date('Y-m-d H:i:s'),
                          'updated_at' => date('Y-m-d H:i:s'),
                          ]);
            $ret = $model->save();

            
        }catch(exception $e){
            DB::rollBack();
            return false;
        }

        DB::commit();
        return $ret;
    }
}
