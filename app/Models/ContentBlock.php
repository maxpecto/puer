<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    /** @use HasFactory<\Database\Factories\ContentBlockFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'image_path',
        'link_text',
        'link_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
