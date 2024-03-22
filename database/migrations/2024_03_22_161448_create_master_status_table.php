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
        Schema::create('master_status', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->longText('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        $data = [
            ['name' => 'Enable Materi', 'description' => 'Status publikasi materi'],
            ['name' => 'Disable Materi', 'description' => 'Menonaktifkan materi yang ditampilkan untuk user'],
            ['name' => 'Draft', 'description' => 'Menyimpan sementara materi yang diupload'],
            ['name' => 'Active Tutorial', 'description' => 'Enable publikasi video tutorial'],
            ['name' => 'Disable Tutorial', 'description' => 'Disabled tutorial'],
            ['name' => 'Draft', 'description' => 'Draft'],
            ['name' => 'Enable Static Pages', 'description' => 'Khusus memperbarui komponen web'],
        ];

        DB::table('master_status')->insert($data);

        DB::table('master_status')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_status');
    }
};