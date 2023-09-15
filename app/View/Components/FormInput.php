<?php

namespace App\View\Components;

use App\View\Components\FormComponent;

class FormInput extends FormComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        // $name, $label, $error, $placeholder, $value
        return view('components.form.input');
    }
}
