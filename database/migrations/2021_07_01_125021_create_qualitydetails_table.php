<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualitydetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quality_id');
            $table->integer('qualitytype_id');
            $table->integer('urun_id');
            $table->double('amount')->nullable();
            $table->integer('unit_id')->nullable();
            $table->longText('explanation')->nullable();
            $table->double('price')->nullable();
            $table->double('sum')->nullable();
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
        Schema::dropIfExists('qualitydetails');
    }
}
