<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id'); // Foreign key to the customers table
            $table->unsignedBigInteger('laundry_id'); // Foreign key to the laundries table
            $table->date('tanggal_masuk');
            $table->decimal('berat', 8, 2);
            $table->string('metode_pembayaran');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            // Define foreign keys
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->foreign('laundry_id')->references('id')->on('laundries')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
