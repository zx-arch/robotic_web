<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Tutorials extends Model
{
    use SoftDeletes;
    protected $table = 'tutorials';
    protected $fillable = [
        'video_name',
        'category',
        'thumbnail',
        'path_video',
        'url',
        'status_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::checkAndCreateTable();
    }

    private static function checkAndCreateTable()
    {
        if (!Schema::hasTable('tutorials')) {
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
                    'thumbnail' => url('/assets/youtube/product video/robo-link-thumb.png'),
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

        } elseif (Tutorials::count() == 0) {
            // Insert data jika tabel kosong
            $data = [
                [
                    'video_name' => 'Robo Link Basic',
                    'category' => 'product video',
                    'thumbnail' => url('/assets/youtube/product video/robo-link-thumb.png'),
                    'path_video' => url('/assets/youtube/product video/Robo Links Basic.mp4'),
                    'url' => 'https://youtu.be/ExJNoBxY23M?si=1H-s3o2SGKRM0BWI',
                    'status_id' => 5
                ],
            ];

            Tutorials::insert($data);
        }
    }

    public static function randomVideo($count)
    {
        if ($count > 1) {
            return Tutorials::inRandomOrder()->take($count)->get();
        } else {
            return Tutorials::inRandomOrder()->first(); // Mengambil satu objek secara acak
        }
    }

}