<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaydetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paydetails', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('type_id')->nullable();
            $table->integer('pay_id')->nullable();
            $table->date('vadetrh')->nullable();
            $table->double('miktar')->nullable();
            $table->integer('kur_id')->nullable();
            $table->integer('payloadtype_id')->nullable();
            $table->string('banka')->nullable();
            $table->string('asilkisi')->nullable();
            $table->string('evrakno')->nullable();
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
        Schema::dropIfExists('paydetails');
    }
}
