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
    Schema::table('bukus', function (Blueprint $table) {
        $table->string('gambar_buku')->nullable();
    });
}

public function down(): void
{
    Schema::table('bukus', function (Blueprint $table) {
        $table->dropColumn('gambar_buku');
    });
}
};
