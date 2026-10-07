<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'vehicle_type',
        'description',
        'image_path',
        'seat_count',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'seat_count' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function bookingEnquiries(): HasMany
    {
        return $this->hasMany(BookingEnquiry::class);
    }

    public function seoMetadata(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }
}
