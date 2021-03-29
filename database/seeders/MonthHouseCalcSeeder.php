<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\MonthHouseCalc;

class MonthHouseCalcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('MonthHouseCalc')->delete();

        \App\Models\MonthHouseCalc::create([
                'month' => date('Y-m'),
                'yatin' => 0,
                'eat' => 0,
                'gasu' => 0,
                'denki' => 0,
                'suidou' => 0,
                'tuushin' => 0,
                'loan' => 0,
                'comment' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }
}
