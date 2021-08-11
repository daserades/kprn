<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no')->nullable();
            $table->integer('firma_id')->nullable();
            $table->integer('ship_id')->nullable();
            $table->date('trh')->nullable();
            $table->date('vadetrh')->nullable();
            $table->double('miktar')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('payloadtype_id')->nullable();
            $table->string('banka')->nullable();
            $table->string('kesideyeri')->nullable();
            $table->string('sube')->nullable();
            $table->string('evrakno')->nullable();
            $table->longText('aciklama')->nullable();
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
        Schema::dropIfExists('pays');
    }
}
