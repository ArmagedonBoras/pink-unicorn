<?php

namespace App\Models;

use App\Filters\TagFilters;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'label', 'type', 'protected'];
    protected $casts = ['protected' => 'boolean'];

    public static function ofType($type)
    {
        return Tag::all()->where('type', $type);
    }

    public static function byName($name, $type=null)
    {
        if (null !== $type) {
            return self::where('name', $name)->where('type', $type)->first();
        }
        return self::where('name', $name)->first();
    }

    public static function byLabel($name, $type=null)
    {
        if (null !== $type) {
            return self::where('label', $name)->where('type', $type)->first();
        }
        return self::where('label', $name)->first();
    }

    public static function tagNames(string $type = null)
    {
        if (null === $type) {
            return Tag::all()->pluck('name');
        }
        return Tag::all()->where('type', $type)->pluck('name');
    }

    public static function typeNames()
    {
        return Tag::all()->pluck('type');
    }

    public function scopeFilter($query, TagFilters $filters)
    {
        return $filters->apply($query);
    }

    public static function createMany(array $tags, string $type = '', $protected = false): Collection
    {
        $created = [];
        foreach ($tags as $tag => $label) {
            $tagObject = self::create(['name' => $tag, 'label' => $label, 'type' => $type, 'protected' => $protected]);
            $created[$tagObject->id] = $tagObject;
        }
        return collect($created);
    }

    public function getLabelAttribute()
    {
        return $this->attributes['label'] ?? $this->attributes['name'];
    }
}
