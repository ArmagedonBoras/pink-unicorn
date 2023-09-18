<?php

namespace App\Http\Livewire\Pages;

use App\Models\Menu;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class EditPage extends Component
{
    public Page $page;
    public Menu $menu;
    public array $images;
    public $parents;
    public $gates;
    public $roles;
    public $image;

    protected $rules = [
        'page.title' => 'required|max:255',
        'page.tagline' => '',
        'page.body' => 'required',
        'page.title_image' => '',
        'page.title_size' => 'int',
        'page.active' => 'boolean',
        'image' => 'image',
        'menu.name' => 'required|max:255',
        'menu.link' => 'required',
        'menu.parent' => '',
        'menu.gate' => '',

    ];

    public function selectImage($image)
    {
        $this->page->title_image = $image;
    }

    public function mount(Page $page)
    {
        if ($page === null) {
            $this->page = new Page();
            $this->menu = new Menu();
        } else {
            $this->menu = Menu::where('page_id', $this->page->id)->first();
        }
        $this->init();
    }

    protected function init()
    {
        Gate::authorize('update', $this->page);
        Gate::authorize('update', $this->menu);
        $this->images = Storage::disk('public')->allFiles('/images');
        $this->parents = Menu::getParents();
        $this->gates = Permission::get()->pluck('label', 'name')->toArray();
        $this->roles = Role::get()->pluck('label', 'name')->toArray();
        //dd($this->gates, $this->roles);
    }

    public function save()
    {
        $this->validate();
        $this->page->save();
        $this->menu->save();
    }

    public function render()
    {
        /**
         * @var $view ViewFactory
         */
        $view =  view('livewire.pages.edit-page');
        return $view->layout('layouts.app', ['title' => 'Redigera statisk sida']);
    }
}
