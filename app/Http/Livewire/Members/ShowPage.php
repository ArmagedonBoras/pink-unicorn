<?php

namespace App\Http\Livewire\Members;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowPage extends Component
{
    public User $user;
    public $watchesFields = [];
    public $watches = [];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        /**
         * @var $view ViewFactory
         */
        $view = view('livewire.members.show-page');
        $title = $this->user->profile_id . ' ' . $this->user->name;
        return $view->layout('layouts.app', ['title' => $title]);
    }
}
