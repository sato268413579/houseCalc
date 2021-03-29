<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MonthHouseCalc extends Model
{
    use HasFactory;
    protected $table = 'MonthHouseCalc';

    //fill()を使用する場合はfillableかguardedどちらかを指定しなければいけない
    //fillable = ホワイトリスト的に
    //guarded = ブラックリスト的に
    protected $fillable = ['month', 'yatin', 'eat', 'gasu', 'denki', 'suidou', 'tuushin', 'loan', 'comment'];

    protected $primaryKey = 'month';

    //monthプロパティがstring→intになってしまう為
    protected $casts = [
        'month' => 'string'
    ];

    public string $month = '';
    public string $yatin = '';
    public string $eat = '';
    public string $gasu = '';
    public string $denki = '';
    public string $suidou = '';
    public string $tuushin = '';
    public string $loan = '';
    public string $comment = '';

    /**
     * 当月のデータ取得
     */
    public function getToMonthData(){
        return $this::where('month', '=',date('Y-m'))->first();
    }

    /**
     * データ登録処理
     */
    public function register(MonthHouseCalc $model){
        DB::beginTransaction();
        try{
            DB::transaction(function () {
                
            });
            $model->fill(['month' => $model['month'],
                          'yatin' => $model['yatin'],
                          'eat' => $model['eat'],
                          'gasu' => $model['gasu'],
                          'denki' => $model['denki'],
                          'suidou' => $model['suidou'],
                          'tuushin' => $model['tuushin'],
                          'loan' => $model['loan'],
                          'comment' => $model['comment']]);
            $ret = $model->save();

            
        }catch(exception $e){
            DB::rollBack();
            return false;
        }

        DB::commit();
        return $ret;
    }
}
