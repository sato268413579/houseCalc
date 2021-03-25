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

        for($i = 1; $i <= 12; $i++){
            \App\Models\MonthHouseCalc::create([
                'month' => date('Y-0').$i,
                'created_at' => date('Y-m-i'),
                'updated_at' => date('Y-m-i'),
            ]);
        }
    }
}
