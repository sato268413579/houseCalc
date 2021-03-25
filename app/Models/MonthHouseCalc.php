<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MonthHouseCalc extends Model
{
    use HasFactory;
    protected $table = 'MonthHouseCalc';

    public function getData(){
        return DB::table($this->table)->get();
    }
}
