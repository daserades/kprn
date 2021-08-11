<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caris', function (Blueprint $table) {
            $table->bigIncrements('id');
           $table->integer('firma_id');
            $table->integer('ship_id');
            $table->integer('pay_id');
            $table->integer('paydetail_id')->nullable();
            $table->integer('order_id');
            $table->date('trh');
            $table->date('vadetrh');
            $table->double('tutar');
            $table->double('alinantutar');
            $table->integer('kur_id');
            $table->longText('aciklama');
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
        Schema::dropIfExists('caris');
    }
}
