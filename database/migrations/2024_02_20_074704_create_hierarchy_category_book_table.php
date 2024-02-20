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
        Schema::create('hierarchy_category_book', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hierarchy_name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->timestamps();
        });

        $data = [
            ['name' => 'Block Programming', 'hierarchy_name' => 'Block Programming', 'parent_id' => null, 'language_id' => 7],
            ['name' => 'Python Programming', 'hierarchy_name' => 'Python Programming', 'parent_id' => null, 'language_id' => 7],
            ['name' => 'Basic', 'hierarchy_name' => 'Block Programming > Basic', 'parent_id' => 1, 'language_id' => 7],
            ['name' => 'Intermediate', 'hierarchy_name' => 'Block Programming > Intermediate', 'parent_id' => 1, 'language_id' => 7],
            ['name' => 'Advanced', 'hierarchy_name' => 'Block Programming > Advanced', 'parent_id' => 1, 'language_id' => 7],
            ['name' => 'Stop and Go', 'hierarchy_name' => 'Block Programming > Basic > Stop and Go', 'parent_id' => 3, 'language_id' => 7],
            ['name' => 'Making a Light Show', 'hierarchy_name' => 'Block Programming > Basic > Making a Light Show', 'parent_id' => 3, 'language_id' => 7],
            ['name' => 'Making a Robot Car', 'hierarchy_name' => 'Block Programming > Basic > Making a Robot Car', 'parent_id' => 3, 'language_id' => 7],
            ['name' => 'Automatic Doors', 'hierarchy_name' => 'Block Programming > Basic > Automatic Doors', 'parent_id' => 3, 'language_id' => 7],
            ['name' => 'Controlling a Motor Cars', 'hierarchy_name' => 'Block Programming > Intermediate > Controlling a Motor Cars', 'parent_id' => 4, 'language_id' => 7],
            ['name' => 'Electronic Instrument', 'hierarchy_name' => 'Block Programming > Intermediate > Electronic Instrument', 'parent_id' => 4, 'language_id' => 7],
            ['name' => 'Robots at Work', 'hierarchy_name' => 'Block Programming > Intermediate > Robots at Work', 'parent_id' => 4, 'language_id' => 7],
            ['name' => 'Machines and Mechanisms', 'hierarchy_name' => 'Block Programming > Intermediate > Machines and Mechanisms', 'parent_id' => 4, 'language_id' => 7],
            ['name' => 'The World of Games', 'hierarchy_name' => 'Block Programming > Intermediate > The World of Games', 'parent_id' => 4, 'language_id' => 7],
            ['name' => 'Playing with Controllers', 'hierarchy_name' => 'Block Programming > Advanced > Playing with Controllers', 'parent_id' => 5, 'language_id' => 7],
            ['name' => 'All About Walkbots', 'hierarchy_name' => 'Block Programming > Advanced > All About Walkbots', 'parent_id' => 5, 'language_id' => 7],
            ['name' => 'The Factory Scanbot', 'hierarchy_name' => 'Block Programming > Advanced > The Factory Scanbot', 'parent_id' => 5, 'language_id' => 7],
            ['name' => 'Advanced Game Making', 'hierarchy_name' => 'Block Programming > Advanced > Advanced Game Making', 'parent_id' => 5, 'language_id' => 7],
            ['name' => 'Introduction', 'hierarchy_name' => 'Python Programming > Introduction', 'parent_id' => 2, 'language_id' => 7],
            ['name' => 'Programming Basic', 'hierarchy_name' => 'Python Programming > Programming Basic', 'parent_id' => 2, 'language_id' => 7],
            ['name' => 'Programming Basic part 1', 'hierarchy_name' => 'Python Programming > Programming Basic > Programming Basic part 1', 'parent_id' => 19, 'language_id' => 7],
            ['name' => 'Programming Basic part 2', 'hierarchy_name' => 'Python Programming > Programming Basic > Programming Basic part 2', 'parent_id' => 19, 'language_id' => 7],
            ['name' => 'Programming Intermediate', 'hierarchy_name' => 'Python Programming > Programming Intermediate', 'parent_id' => 2, 'language_id' => 7],
            ['name' => 'Programming Hands On part 1', 'hierarchy_name' => 'Python Programming > Programming Advanced > Programming Hands On part 1', 'parent_id' => 25, 'language_id' => 7],
            ['name' => 'Programming Hands On part 2', 'hierarchy_name' => 'Python Programming > Programming Advanced > Programming Hands On part 2', 'parent_id' => 25, 'language_id' => 7],
            ['name' => 'Programming Advanced', 'hierarchy_name' => 'Python Programming > Programming Advanced', 'parent_id' => 2, 'language_id' => 7],
            ['name' => 'Programming Advanced 3', 'hierarchy_name' => 'Python Programming > Programming Advanced > Programming Advanced 3', 'parent_id' => 25, 'language_id' => 7],
        ];

        DB::table('hierarchy_category_book')->insert($data);

        DB::table('hierarchy_category_book')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hierarchy_category_book');
    }
};