<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = '', string $icon="")
    {
        $this->type = empty($type) ? 'success' : $type;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
