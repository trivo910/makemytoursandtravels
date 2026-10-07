<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    protected $fillable = [
        'title',
        'description',
        'canonical_url',
        'focus_keyword',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'robots_index',
        'robots_follow',
        'schema_json',
    ];

    protected function casts(): array
    {
        return [
            'robots_index' => 'boolean',
            'robots_follow' => 'boolean',
            'schema_json' => 'array',
        ];
    }

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
