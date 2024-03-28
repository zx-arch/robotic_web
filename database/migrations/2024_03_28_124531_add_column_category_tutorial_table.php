<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('category_tutorial', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
        });

        DB::table('category_tutorial')->update([
            'status_id' => 11,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_tutorial', function (Blueprint $table) {
            // Menghapus kolom status_id
            $table->dropColumn('status_id');
        });
    }
};