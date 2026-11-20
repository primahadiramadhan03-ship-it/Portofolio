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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable(); // Untuk pengaturan halaman
            $table->text('deskripsi_singkat')->nullable(); // Untuk pengaturan halaman
            $table->string('nama_pengirim');
            $table->string('email_pengirim');
            $table->text('pesan_pengirim');
            $table->text('media_sosial')->nullable(); // Bisa diisi format JSON atau teks link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
