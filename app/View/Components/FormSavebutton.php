<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class FormSavebutton extends Component
{
    public $delete;
    public $deleteText;
    public $reset;
    public $resetText;
    public $submit;
    public $submitText;
    public $divClass;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $delete = null, string $reset = null, string $submit = null, string $divClass = '', string $label = null)
    {
        $this->deleteText = empty($delete) ? 'Radera' : $delete;
        $this->delete = (null !== $delete);                          // show if is set

        $this->resetText = empty($reset) ? 'Återställ' : $reset;
        $this->reset = (null !== $reset);                            // show if is set

        $this->submitText = empty($submit) ? 'Spara' : $submit;
        $this->submit = ("false" !== Str::lower($submit));           // show unless set to false

        $this->divClass = $divClass;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.savebutton');
    }
}
