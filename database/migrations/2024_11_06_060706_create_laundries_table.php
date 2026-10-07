<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_laundry'); // By weight or by item
            $table->string('jenis_layanan'); // Wash and iron or wash and fold
            $table->decimal('tarif_layanan', 10, 2);
            $table->string('durasi_layanan'); // Express, 2 days, or 3 days
            $table->string('keterangan'); // Service notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
