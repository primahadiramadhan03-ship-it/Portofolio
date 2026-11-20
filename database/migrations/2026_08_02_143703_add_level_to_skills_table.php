<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->string('level')->nullable()->after('isi_skill');
        });
    }

    public function down()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
};