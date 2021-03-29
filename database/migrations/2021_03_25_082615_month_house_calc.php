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
            // $table->increments('id');        // デフォルト
            $table->string('month');        // カラム作成
            $table->integer('yatin');        // カラム作成
            $table->integer('eat');        // カラム作成
            $table->integer('gasu');        // カラム作成
            $table->integer('denki');        // カラム作成
            $table->integer('suidou');        // カラム作成
            $table->integer('tuushin');        // カラム作成
            $table->integer('loan');        // カラム作成
            $table->string('comment');        // カラム作成
            $table->timestamp('created_at');        // カラム作成
            $table->timestamp('updated_at');        // カラム作成

            $table->unique(['month']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MonthHouseCalc');
    }
}
