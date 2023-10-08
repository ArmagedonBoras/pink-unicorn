<?php

namespace App\Livewire\Tv;

use Livewire\Component;

class Tv extends Component
{
    public function render()
    {
        return view('livewire.tv.tv')->layout('layouts.tv');
    }
}
