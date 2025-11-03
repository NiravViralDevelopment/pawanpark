<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'description',
        'image',
        'rating',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}

