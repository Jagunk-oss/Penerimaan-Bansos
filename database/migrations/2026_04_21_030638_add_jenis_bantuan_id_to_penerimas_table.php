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
        Schema::table('penerima', function (Blueprint $table) {
        $table->foreignId('jenis_bantuan_id')
              ->constrained('jenis_bantuans')
              ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerima', function (Blueprint $table) {
        $table->dropForeign(['jenis_bantuan_id']);
        $table->dropColumn('jenis_bantuan_id');
        });
    }
};
