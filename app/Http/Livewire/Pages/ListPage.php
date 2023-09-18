<?php

namespace App\Http\Livewire\Pages;

use App\Models\Menu;
use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class ListPage extends Component
{
    public function render()
    {
        Gate::authorize('update', Page::class);
        Gate::authorize('update', Menu::class);
        $data = [
            'pages' => Page::latest()->paginate(100),
        ];

        /**
         * @var $view ViewFactory
         */
        $view =  view('livewire.pages.list-page', $data);
        return $view->layout('layouts.app', ['title' => 'Statiska sidor']);
    }
}
