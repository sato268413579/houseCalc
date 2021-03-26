<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\syunyuMaster;

class SyunyuMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\syunyuMaster::create([
                'syunyu' => '294088',
                'created_at' => date('Y-m-i'),
                'updated_at' => date('Y-m-i'),
            ]);
    }
}
