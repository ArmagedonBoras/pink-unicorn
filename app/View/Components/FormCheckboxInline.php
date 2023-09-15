<?php

namespace App\View\Components;

class FormCheckboxInline extends FormComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.checkbox-inline');
    }
}
