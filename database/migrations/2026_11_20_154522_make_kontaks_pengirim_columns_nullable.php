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
        Schema::table('kontaks', function (Blueprint $table) {
            $table->string('nama_pengirim')->nullable()->change();
            $table->string('email_pengirim')->nullable()->change();
            $table->text('pesan_pengirim')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->string('nama_pengirim')->nullable(false)->change();
            $table->string('email_pengirim')->nullable(false)->change();
            $table->text('pesan_pengirim')->nullable(false)->change();
        });
    }
};
