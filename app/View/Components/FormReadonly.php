<?php

namespace App\View\Components;

use App\View\Components\FormComponent;

class FormReadonly extends FormComponent
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function boot()
    {
        if (null !== $this->options) {
            $newOptions = [];
            foreach ($this->options as $key => $item) {
                if (is_array($item)) {
                    foreach ($item as $itemkey => $value) {
                        $newOptions[$itemkey] = $value;
                    }
                } else {
                    $newOptions[$key] = $item;
                }
            }
            $this->options = $newOptions;
            $this->value = $this->options[$this->value] ?? $this->value;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.readonly');
    }
}
