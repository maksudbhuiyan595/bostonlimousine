<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'hero_heading',
        'hero_subheading',
        'content_blocks',
        'is_active',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'is_active' => 'boolean',
    ];
}
