<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MenuPage extends Component
{
    public Menu $menu;
    public $menus;
    public $gates;
    public $roles;
    public $gate = 'all';
    public function render()
    {
        if ($this->gate === 'all') {
            $this->menus = Menu::where('parent', '')->orderBy('sort_order')->get();
        } else {
            $this->menus = Menu::menu();
        }
        $this->gates = Permission::get('label', 'name')->pluck('label', 'name')->toArray();
        $this->roles = Role::get('label', 'name')->pluck('label', 'name')->toArray();
        /**
         * @var $view ViewFactory
         */
        $view = view('livewire.menu-page');
        return $view->layout('layouts.app', ['title' => 'Menyer']);
    }
}
