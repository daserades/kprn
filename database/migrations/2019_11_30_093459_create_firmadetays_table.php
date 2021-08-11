<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmadetaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmadetays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('firma_id');
            $table->integer('vade');
            $table->integer('iskonta');
            $table->integer('kur_id');
            $table->integer('limit');
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
        Schema::dropIfExists('firmadetays');
    }
}
