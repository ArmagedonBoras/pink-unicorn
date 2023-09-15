<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgressBarLight extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $items,
        public int $active = 1,
        public string $status = '#dd8500',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.progress-bar-light');
    }
}
