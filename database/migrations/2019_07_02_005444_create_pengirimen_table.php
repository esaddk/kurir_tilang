<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('diambil')->nullable();
            $table->string('antri')->nullable();
            $table->string('diantar')->nullable();
            $table->string('diterima')->nullable();
            $table->string('nama_penerima')->nullable();
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
        Schema::dropIfExists('pengirimen');
    }
}
