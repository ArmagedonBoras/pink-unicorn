<?php

namespace App\View\Components;

use App\View\Components\FormComponent;

class FormRadioInline extends FormComponent
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.radio-inline');
    }
}
