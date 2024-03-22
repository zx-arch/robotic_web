<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('level_name', 50);
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('hierarchy_id');
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });

        $data = [
            ['level_name' => 'Basic', 'language_id' => '7', 'hierarchy_id' => 3],
            ['level_name' => 'Intermediate', 'language_id' => '7', 'hierarchy_id' => 4],
            ['level_name' => 'Advanced', 'language_id' => '7', 'hierarchy_id' => 5],
            ['level_name' => 'Dasar', 'language_id' => '67', 'hierarchy_id' => 30],
            ['level_name' => 'Menengah', 'language_id' => '67', 'hierarchy_id' => 31],
            ['level_name' => 'Lanjutan', 'language_id' => '67', 'hierarchy_id' => 32],
        ];

        DB::table('levels')->insert($data);

        DB::table('levels')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};