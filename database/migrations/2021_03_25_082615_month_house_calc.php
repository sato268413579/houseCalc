<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MonthHouseCalc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MonthHouseCalc', function (Blueprint $table) {
            $table->increments('id');        // デフォルト
            $table->string('month');        // カラム作成
            $table->string('created_at');        // カラム作成
            $table->string('updated_at');        // カラム作成
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
