<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MonthHouseCalc extends Model
{
    use HasFactory;
    protected $table = 'MonthHouseCalc';

    /**
     * 当月のデータ取得
     */
    public function getToMonthData(){
        return DB::table($this->table)
                ->where('month', date('Y-m'))
                ->first();
    }
}
