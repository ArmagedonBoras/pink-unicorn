<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

trait Taggable
{
    public function taggables(string $type = null)
    {
        if ($type === null) {
            return $this->morphToMany(Tag::class, 'taggable', 'taggables');
        } else {
            return $this->morphToMany(Tag::class, 'taggable', 'taggables')->where('type', $type);
        }
    }

    public function tags(string $type = null)
    {
        return $this->taggables($type);
    }

    public function hasTag($tag, $type = '')
    {
        if (is_string($tag)) {
            $tag = $this->tags()->first();
        }
        return ($tag !== null);
    }

    public function hasTagType($type)
    {
        $tag = $this->tags($type)->first();
        return ($tag !== null);
    }

    /**
     * tag
     *
     * @param  string|Tag $tag
     * @return void
     */
    public function tag($tag, string $type = '')
    {
        if (is_string($tag)) {
            $tag = Tag::firstOrCreate(['name' => $tag, 'type' => $type]);
        }
        if (is_a($tag, Tag::class)) {
            if (!$this->hasTag($tag)) {
                return $this->tags()->save($tag);
            }
        }
    }

    public function untag(Tag $tag)
    {
        if ($this->tags()->contains($tag)) {
            return $this->tags()->detach($tag);
        }
    }

    public static function byTag($tag, string $type = '')
    {
        if (is_string($tag)) {
            $tag = Tag::where('name', $tag)->where('type', $type)->first();
        }

        if ($tag !== null) {
            $items = $tag->morphedByMany(__CLASS__, 'taggable', 'taggables')->get();
            return $items;
        }
        return new Collection();
    }

    public static function byTagType(string $type = '')
    {
        $tags = Tag::all()->where('type', $type);
        $items = new Collection();
        foreach($tags as $tag) {
            $class = __CLASS__;
            $itemList = $class::byTag($tag);
            $items->prepend($itemList);
            //dd($itemList, $items);
        }

        return $items->flatten();
    }
}
