<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTutorial extends Model
{
    protected $table = 'category_tutorial';
    protected $fillable = [
        'category'
    ];
}