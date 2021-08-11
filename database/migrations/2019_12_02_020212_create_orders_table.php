<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firma_id');
            $table->integer('firmadetay_id');
            $table->integer('orderstatuses_id');
            $table->datetime('sevktrh');
            $table->integer('iskonta');
            $table->integer('vade');
            $table->string('no');
            $table->integer('bazkur')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('koliadet')->nullable();
            $table->longText('sevkadres')->nullable();
            $table->longText('aciklama')->nullable();
            $table->integer('users_id');
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
        Schema::dropIfExists('orders');
    }
}
