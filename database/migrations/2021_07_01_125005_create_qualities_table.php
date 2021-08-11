<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firma_id');
            $table->integer('firmadetay_id')->nullable();
            $table->integer('kur_id')->nullable();
            $table->datetime('sevktrh')->nullable();
            $table->integer('iskonta')->nullable();
            $table->integer('vade')->nullable();
            $table->integer('bazkur')->nullable();
            $table->string('dispatchno')->nullable();
            $table->longText('explanation')->nullable();
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
        Schema::dropIfExists('qualities');
    }
}
