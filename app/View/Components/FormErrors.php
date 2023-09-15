<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormErrors extends Component
{
    public $error;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
        @if (!empty($errors->all()))
            <span class="text-danger font-weight-bold">Formuläret innehåller fel</span>
        @endif
blade;
    }
}
