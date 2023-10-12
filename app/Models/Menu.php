<?php

namespace App\Models;

use App\Models\Page;
use App\Traits\HasGate;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    use HasGate;

    // protected $with = ['page'];
    protected $children = null;

    protected $guarded = [];

    public static function menu($parent = '')
    {
        $menus = self::where('parent', $parent)->orderBy('sort_order', 'asc')->get();
        $approved = new Collection();
        foreach ($menus as $menu) {
            if ($menu->isAuthorized()) {
                $approved->push($menu);
            }
        }

        return $approved;
    }

    public static function getParents()
    {
        $parents = self::where('parent', '')->pluck('link', 'link')->toArray();
        $parents['user'] = "user";
        return $parents;
    }

    public function getParent()
    {
        if ($this->parent === '') {
            return null;
        }
        return Menu::where('link', $this->parent)->first();
    }

    public function hasChildren()
    {
        if ($this->children === null) {
            $this->children = $this->getChildren();
        }
        return $this->children->count() > 0;
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getChildren()
    {
        if ($this->children === null) {
            $this->children = self::menu($this->link);
        }
        return $this->children;
    }


    public function getFullLinkAttribute()
    {
        return $this->getLink();
    }

    public function getLink()
    {
        if ($this->parent === '') {
            return '/' . $this->link;
        }
        return $this->getParent()->getLink() . "/" . $this->link;
    }

    public function getGateOptionsAttribute()
    {
        $gates = Permission::get()->pluck('label', 'name')->toArray();
        foreach ($gates as $gate => $label) {
            $gates[$gate] = $label . ' - ' . $gate;
        }
        $roles = Role::get()->pluck('label', 'name')->toArray();
        return ['' => 'Alla kan se', 'Roller' => $roles, 'Rättigheter' => $gates,];
    }

    public function getParentOptionsAttribute()
    {
        $parents = $this->getParents();
        $parents[''] = 'Ingen överstående länk';
        $parents['user'] = "Användarens meny";
        return $parents;
    }
}
