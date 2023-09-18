<?php

namespace App\Http\Livewire\Pages;

use App\Models\Menu;
use App\Models\Page;
use App\Http\Livewire\Pages\EditPage;
use Illuminate\Support\Facades\Storage;

class CreatePage extends EditPage
{
    public function mount(Page $page)
    {
        $this->page = new Page();
        $this->menu = new Menu();
        $this->init();
    }

    public function save()
    {
        $this->validate();
        $this->page->save();
        $this->menu->page_id = $this->page->id;
        $this->menu->save();
    }

    public function render()
    {
        /**
         * @var $view ViewFactory
         */
        $view =  view('livewire.pages.edit-page');
        return $view->layout('layouts.app', ['title' => 'Skapa statisk sida']);
    }
}
