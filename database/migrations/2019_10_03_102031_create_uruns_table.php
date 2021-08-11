<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uruns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('no')->nullable();
            $table->double('barkod')->nullable();
            $table->integer('urunaltkategori_id')->nullable();
            $table->integer('ebat_id')->nullable();
            $table->integer('models_id')->nullable();
            $table->integer('urunozellik1_id')->nullable();
            $table->integer('urunozellik2_id')->nullable();
            $table->integer('urunozellik3_id')->nullable();
            $table->integer('urunozellik4_id')->nullable();
            $table->integer('urunozellik5_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('paketiciadet')->nullable();
            $table->integer('koliiciadet')->nullable();
            $table->integer('ambalajtur_id')->nullable();
            $table->integer('paketiciozellik_id')->nullable();
            $table->integer('renk1_id')->nullable();
            $table->integer('renk2_id')->nullable();
            $table->integer('renk3_id')->nullable();
            $table->integer('renk4_id')->nullable();
            $table->integer('renk5_id')->nullable();
            $table->integer('renk6_id')->nullable();
            $table->integer('hacim')->nullable();
            $table->integer('gramaj')->nullable();
            $table->integer('asgaristok')->nullable();
            $table->string('ipliktur')->nullable();
            $table->longText('icerik')->nullable();
            $table->longText('aciklama')->nullable();
            $table->integer('ticarikod')->nullable();
            $table->string('ticariad')->nullable();
            $table->string('tmad')->nullable();
            $table->integer('tmkod')->nullable();
            $table->integer('urunturu_id')->nullable();
            $table->integer('durum_id');
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
        Schema::dropIfExists('uruns');
    }
}
