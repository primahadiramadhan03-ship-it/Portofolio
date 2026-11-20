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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->string('foto'); // Menyimpan nama file foto
            $table->string('judul');
            $table->text('deskripsi_singkat');
            // Kategori dibatasi hanya 3 pilihan sesuai filter di web kamu
            $table->enum('kategori', ['project', 'organization', 'certificate']); 
            $table->string('judul_isi');
            $table->text('deskripsi_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};
