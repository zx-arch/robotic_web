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
            $table->boolean('valid_deleted')->default(true);
            $table->text('delete_html_code')->default('<a class="btn btn-danger btn-sm btn-delete" href="#" title="Delete" aria-label="Delete" data-pjax="0" onclick="confirmDelete(event)"><i class="fa-fw fas fa-trash" aria-hidden></i></a>');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_tutorial', function (Blueprint $table) {
            $table->dropColumn('valid_deleted');
            $table->dropColumn('delete_html_code');

        });
    }
};