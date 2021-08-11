<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currents', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('order_id')->nullable();
            $table->integer('firma_id')->nullable();
            $table->integer('ship_id')->nullable();
            $table->integer('pay_id')->nullable();
            $table->integer('paydetail_id')->nullable();
            $table->date('vadetrh')->nullable();
            $table->double('debt')->nullable();
            $table->double('paid')->nullable();
            $table->double('kur_id')->nullable();
            $table->integer('durum_id')->nullable();
            $table->integer('close_id')->nullable();
            $table->integer('open_id')->nullable();
            $table->integer('option')->nullable();
            $table->integer('users_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currents');
    }
}
