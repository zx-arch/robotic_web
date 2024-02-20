<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('hierarchy_id');
            $table->string('file');
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });

        // Insert data
        $data = [
            [
                'book_title' => 'Stop and Go',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 6,
                'file' => 'Basic 01_Stop and Go.pdf'
            ],
            [
                'book_title' => 'Making a Light Show',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 7,
                'file' => 'Basic 02_Making a Light Show.pdf'
            ],
            [
                'book_title' => 'Making a Robot Car',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 8,
                'file' => 'Basic 03_Making a Robot Car.pdf'
            ],
            [
                'book_title' => 'Automatic Doors',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 9,
                'file' => 'Basic 04_Automatic Doors.pdf'
            ],
            [
                'book_title' => 'Controlling a Motor Cars',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 10,
                'file' => 'Intermediate 01_Controlling Motor Cars.pdf'
            ],
            [
                'book_title' => 'Electronic Instrument',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 11,
                'file' => 'Intermediate 02_Electronic Instruments.pdf'
            ],
            [
                'book_title' => 'Robots at Work',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 12,
                'file' => 'Intermediate 03_Robots at Works.pdf'
            ],
            [
                'book_title' => 'Machines and Mechanisms',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 13,
                'file' => 'Intermediate 04_Machines and Mechanismss.pdf'
            ],
            [
                'book_title' => 'The World of Games',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 14,
                'file' => 'Intermediate 05_The World of Gamess.pdf'
            ],
            [
                'book_title' => 'Playing with Controllers',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 15,
                'file' => 'Advanced 01_Playing with Controllerss.pdf'
            ],
            [
                'book_title' => 'All About Walkbots',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 16,
                'file' => 'Advanced 02_All About Walkbotss.pdf'
            ],
            [
                'book_title' => 'The Factory Scanbot',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 17,
                'file' => 'Advanced 03_The Factory Scanbots.pdf'
            ],
            [
                'book_title' => 'Advanced Game Making',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 18,
                'file' => 'Advanced 04_Advanced Game Makings.pdf'
            ],
            [
                'book_title' => 'Introduction',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 19,
                'file' => 'Introduction.pdf'
            ],
            [
                'book_title' => 'Programming Basic 1',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 21,
                'file' => 'Programming Basics_Part 1.pdf'
            ],
            [
                'book_title' => 'Programming Basic 2',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 22,
                'file' => 'Programming Basics_Part 2.pdf'
            ],
            [
                'book_title' => 'Programming Hands On part 1',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 24,
                'file' => 'Hands-on Programming_Part 1.pdf'
            ],
            [
                'book_title' => 'Programming Hands On part 2',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 25,
                'file' => '88381_Python_Programing_Hands-On Part 2.pdf'
            ],
            [
                'book_title' => 'Programming Advanced 3',
                'language_name' => 'English',
                'status_id' => 1,
                'hierarchy_id' => 27,
                'file' => '88387_Python_Programing_Advanced_Programing 3_ETC.pdf'
            ]
            // Masukkan data lainnya di sini...
        ];

        foreach ($data as $bookData) {
            DB::table('book_translation')->insert($bookData);
        }
        DB::table('book_translation')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_translation');
    }
};