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
        Schema::create('book_translation', function (Blueprint $table) {
            $table->id();
            $table->string('book_title');
            $table->unsignedBigInteger('language_id');
            $table->string('language_name');
            $table->unsignedBigInteger('status_id');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_translation');
    }
};