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
            $table->increments('id');
            $table->string('kode_order');               
            $table->integer('customer_id');
            $table->integer('admin_id');
            $table->integer('kurir_id');           
            $table->string('penerima');
            $table->string('alamat');
            $table->string('biaya_kirim');
            $table->string('status_pembayaran');
            $table->string('foto_transfer')->default('kosong');
            $table->string('nomor_hp');
            $table->string('foto');
            $table->string('status_data');
            $table->string('pengiriman_id');
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
