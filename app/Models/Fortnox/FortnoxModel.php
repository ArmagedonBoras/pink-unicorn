<?php

namespace App\Models\Fortnox;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class FortnoxModel extends Model
{
    protected $fortnox_key_field = 'number';
    protected $guarded=[];
    protected $cached = true;

    public function __construct()
    {
    }

    protected function getFortnoxKey()
    {
        $key = $this->getFortnoxKeyName();
        return $this->{$key};
    }

    protected function getFortnoxKeyName()
    {
        return $this->fortnox_key_field ?? $this->getKeyName();
    }

    // From Fortnox
    public function updateFromFortnox($data = null)
    {
        if (null === $data) {
            $fn = App::make('App\Models\Fortnox\Fortnox');
            $data = $fn->getOne($this->getFortnoxKey());
        }
        $this->fill(self::fortnoxArrayToAttributes($data, $this->getTable()));
        $this->syncRelatedFortnoxRows($data);
        $this->touch();
        $this->save();
        return $this;
    }

    public static function updateOldFromFortnox()
    {
        self::where('synced_at', '<', now()->subDay())->get()->each->updateFromFortnox();
    }

    public static function createFromFortnox($id)
    {
        $fn = App::make('App\Models\Fortnox\Fortnox');
        $data = $fn->getOne($id);
        $object = self::createFromFortnoxArray($data);
        if (is_object($object)) {
            $object->syncRelatedFortnoxRows($data);
        }
        return $object;
    }

    public static function createAllFromFortnox()
    {
        $fn = App::make('App\Models\Fortnox\Fortnox');
        $newSelf = new self();
        $key = $newSelf->getFortnoxKeyName();
        $studlyKey = Str::studly($key);
        $completeFortnoxItems = $newSelf->completeFortnoxItems ?? false;
        $table = $newSelf->getTable();
        $page = 0;
        $objects = [];
        $data = [];
        do {
            $page++;
            $data = array_merge($data, $fn->getList('', $page));
        } while ($fn->hasMorePages());
        foreach ($data as $item) {
            if ($completeFortnoxItems) {
                $object = self::createFromFortnox($item[$studlyKey]);
            }
            $object = self::createFromFortnoxArray($item);
            $object->syncRelatedFortnoxRows($item);
            $objects[] = $object;
        }
        return $objects;
    }

    public function syncRelatedFortnoxRows($data)
    {
        $relations = $this->fortnox_relations ?? [];
        foreach ($data as $key => $value) {
            if (isset($relations[$key])) {
                $this->{$relations[$key]['attribute']}->each->delete();
                foreach ($value as $row) {
                    $relations[$key]['class']::createFromFortnoxArray($row, $this->id);
                }
            }
        }
    }

    public static function createFromFortnoxArray($data, $foreignKey = null)
    {
        $newSelf = new self();
        $key = $newSelf->getFortnoxKeyName();
        if (null !== $foreignKey) {
            $data[Str::studly($newSelf->fortnox_parent_field)] = $foreignKey;
        }
        $table = $newSelf->getTable();
        $attributes = self::fortnoxArrayToAttributes($data, $table);
        if (!empty($attributes)) {
            if (self::where($key, $attributes[$key] ?? '')->exists()) {
                $object = self::where($key, $attributes[$key])->first();
                $object->fill($attributes);
                $object->touch();
                $object->save();
                return $object;
            } else {
                return self::create($attributes);
            }
        }
        return false;
    }

    // to Fortnox
    public function attributesToFortnoxArray()
    {
        $array = [];
        foreach ($this->fortnox_fields as $field) {
            if (Str::contains($field, 'fortnox')) {
                continue;
            }
            if (null === $this->$field) {
                continue;
            }
            $array[Str::studly($field)] = $this->$field;
        }
        $relations = $this->fortnox_relations ?? [];
        foreach ($relations as $field => $relation) {
            $att = $relation['attribute'];
            foreach ($this->$att as $row) {
                $array[Str::studly($field)][] = $row->attributesToFortnoxArray();
            }
        }
        return $array;
    }

    public static function fortnoxArrayToAttributes($data, $table)
    {
        $attributes = [];
        foreach ($data as $key => $value) {
            $snakeKey = Str::snake($key);
            if (Schema::hasColumn($table, $snakeKey)) {
                if (is_array($value)) {
                    $value = serialize($value);
                }
                if ($value === 'true') {
                    $value = true;
                }
                if ($value === 'false') {
                    $value = false;
                }
                $attributes[$snakeKey] = $value;
            }
        }
        $attributes['synced_at'] = now();
        return $attributes;
    }

    public function updateToFortnox()
    {
        $fn = App::make('App\Models\Fortnox\Fortnox');
        $data = $this->attributesToFortnoxArray();
        $this->updateFromFortnox($fn->put($data, $this->getFortnoxKey()));
        return $this;
    }

    public function createToFortnox()
    {
        $fn = App::make('App\Models\Fortnox\Fortnox');
        $data = $this->attributesToFortnoxArray();
        $updatedData = $fn->post($data);
        $this->updateFromFortnox($updatedData);
        return $this;
    }
}
