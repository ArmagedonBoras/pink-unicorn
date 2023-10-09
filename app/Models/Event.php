<?php

namespace App\Models;

use Attribute;
use App\Models\EventOrganizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }

    public function event_signups(): BelongsToMany
    {
        return $this->belongsToMany(EventSignup::class)->withTimestamps();
    }

    public function event_organizers(): BelongsToMany
    {
        return $this->belongsToMany(EventOrganizer::class)->withTimestamps();
    }

    public function available_rooms()
    {
        return Room::where('bookable', true)->get()->pluck('name', 'id')->toArray();
    }
}
