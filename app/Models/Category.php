<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'email',
    ];
}