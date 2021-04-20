<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InfoModel;

class InfoModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('info')->delete();

        \App\Models\InfoModel::create([
                'day' => date('Y/m/d'),
                'func' => '当日登録',
                'detail' => 'テスト',
            ]);
    }
}
