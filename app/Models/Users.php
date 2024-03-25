<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ExcludeAdminScope;

class Users extends Model
{

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'role',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ExcludeAdminScope);
    }
}