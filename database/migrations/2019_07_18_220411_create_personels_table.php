<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('surname');
            $table->integer('tel');
            $table->integer('departman_id');
            $table->integer('gorevlistesis_id');
            $table->datetime('gtrh');
            $table->datetime('ctrh');
            $table->integer('durums_id');
            $table->integer('users_id');
            $table->longText('adres');
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
        Schema::dropIfExists('personels');
    }
}
