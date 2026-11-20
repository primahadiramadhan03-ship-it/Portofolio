<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->string('link_github')->nullable()->after('media_sosial');
            $table->string('link_linkedin')->nullable()->after('link_github');
            $table->string('link_instagram')->nullable()->after('link_linkedin');
        });
    }

    public function down(): void
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->dropColumn(['link_github', 'link_linkedin', 'link_instagram']);
        });
    }
};
