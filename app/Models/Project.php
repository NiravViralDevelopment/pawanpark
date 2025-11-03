<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'brochure',
        'video',
        'is_featured',
        'is_completed',
        'is_ongoing',
        'location',
        'location_iframe',
        'features_amenities',
        'bedrooms',
        'bathrooms',
        'sqft',
        'year_built',
        'property_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'images' => 'array',
        'features_amenities' => 'array',
        'is_featured' => 'boolean',
        'is_completed' => 'boolean',
        'is_ongoing' => 'boolean',
    ];
}
