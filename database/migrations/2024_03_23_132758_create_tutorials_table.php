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
        Schema::create('tutorials', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('video_name');
            $table->string('category');
            $table->text('thumbnail');
            $table->text('path_video');
            $table->string('url');
            $table->unsignedBigInteger('status_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
        $data = [
            [
                'video_name' => 'Robo Link Basic',
                'category' => 'product video',
                'thumbnail' => 'robo-link-thumb',
                'path_video' => url('/assets/youtube/product video/Robo Links Basic.mp4'),
                'url' => 'https://youtu.be/ExJNoBxY23M?si=1H-s3o2SGKRM0BWI',
                'status_id' => 5
            ],
        ];

        DB::table('tutorials')->insert($data);

        DB::table('tutorials')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorials');
    }
};