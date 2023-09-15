<?php

namespace App\Models;

use App\Models\Menu;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Models\Role;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use Userstamps;

    //protected $with = ['menu'];
    protected $casts = [
        'active' => 'boolean',
    ];

    protected $guarded = [];

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function getLinkAttribute()
    {
        return $this->menu->full_link;
    }

    public function getActiveTextAttribute()
    {
        return $this->active ? 'Ja' : 'Nej';
    }

    public function getGateAttribute()
    {
        return $this->menu->gate;
    }

    public function getActiveOptionsAttribute()
    {
        return [1 => 'Ja', 0 => 'Nej'];
    }

    public function isAuthorized(): bool
    {
        return $this->menu->isAuthorized();
    }
}
