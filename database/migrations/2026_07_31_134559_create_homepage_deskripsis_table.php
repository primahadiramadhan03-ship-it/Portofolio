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
       Schema::create('homepage_deskripsis', function (Blueprint $table) {
        $table->id();
        $table->string('role'); // misal: "Full-Stack Developer"
        $table->string('judul_deskripsi');
        $table->text('catatan_utama');
        $table->text('deskripsi');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_deskripsis');
    }
};
