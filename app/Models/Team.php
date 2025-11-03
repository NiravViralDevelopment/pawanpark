<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'image',
        'position',
        'phone_number',
        'whatsapp_number',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}

