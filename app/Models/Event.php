<?php

namespace App\Models;

use Attribute;
use App\Traits\Taggable;
use App\Traits\Commentable;
use Spatie\Sluggable\HasSlug;
use App\Models\EventOrganizer;
use Illuminate\Support\Carbon;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function test()
    {
        $timestamp = Carbon::now()->timestamp;
        return DB::table('events')->whereRaw("(`recurring_year` = '*' or `recurring_year` = YEAR(FROM_UNIXTIME(?)))", [$timestamp])
        ->whereRaw("(`recurring_month` = '*' or `recurring_month` = MONTH(FROM_UNIXTIME(?)))", [$timestamp])
        ->whereRaw("(`recurring_day` = '*' or `recurring_day` = DAY(FROM_UNIXTIME(?)))", [$timestamp])
        ->whereRaw("(`recurring_week` = '*' or `recurring_week` = WEEK(FROM_UNIXTIME(?)))", [$timestamp])
        ->whereRaw("(`recurring_week_of_month` = '*' or `recurring_week_of_month` = FLOOR((DAY(FROM_UNIXTIME(?)) + 6) / 7))", [$timestamp])
        ->whereRaw("(`recurring_weekday` = '*' or `recurring_weekday` = (WEEKDAY(FROM_UNIXTIME(?)) + 8) % 7)", [$timestamp]);
    }
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
