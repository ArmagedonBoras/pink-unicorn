<?php

namespace App\Models;

use App\Traits\HasGate;
use App\Traits\Taggable;
use App\Traits\Commentable;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use Commentable;
    use Taggable;
    use HasGate;
    use SoftDeletes;
    use HasSlug;

    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('sv');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function shortBodyAttribute()
    {
        return Str::of($this->body)->words(30);
    }
}
