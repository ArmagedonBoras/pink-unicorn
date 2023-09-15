<?php

namespace App\View\Components;

use App\Models\Tag;
use App\View\Components\FormComponent;

class FormTagSelect extends FormComponent
{
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function boot()
    {
        $this->tags = Tag::ofType($this->type);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.tag-select');
    }
}
