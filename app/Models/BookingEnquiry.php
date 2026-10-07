<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingEnquiry extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_RESOLVED = 'resolved';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'pickup_location',
        'destination',
        'travel_date',
        'pickup_time',
        'passenger_count',
        'vehicle_type',
        'vehicle_id',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'travel_date' => 'date',
            'pickup_time' => 'datetime:H:i',
            'passenger_count' => 'integer',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
