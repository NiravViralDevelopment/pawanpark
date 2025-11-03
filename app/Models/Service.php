<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'image',
        'descriptions',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
