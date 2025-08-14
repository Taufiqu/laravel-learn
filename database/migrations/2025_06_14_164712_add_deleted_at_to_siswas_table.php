<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_deleted_at_to_siswas_table.php
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->softDeletes(); // Ini akan otomatis membuat kolom `deleted_at`
        });
    }

    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Ini akan menghapus kolom `deleted_at`
        });
    }
};
