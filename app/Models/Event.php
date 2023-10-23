<?php

namespace App\Models;

use Attribute;
use App\Traits\Taggable;
use App\Traits\Commentable;
use App\Models\EventOrganizer;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;

class Event extends Model
{
    use HasFactory;
    use Commentable;
    use Taggable;
    use HasSlug;

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function owned_by(): BelongsTo
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['starts_at', 'title'])
            ->saveSlugsTo('slug')
            ->usingLanguage('sv');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
