<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\View\Components\FormComponent;

class FormDatePicker extends FormComponent
{
    public $hourOptions;
    public $minCheck = false;
    public $minName = null;
    public $maxCheck = false;
    public $maxName = null;

    protected function boot()
    {
        //$this->value = Carbon::createFromFormat('Y-m-d H:i:s', $this->value);
        foreach (range(0, 23) as $hour) {
            $this->hourOptions[$hour] = sprintf("%02d", $hour).':00';
        }

        if (null !== $this->min && strtotime($this->min) === false) {
            $this->minCheck = true;
            $this->minName = $this->min;
            $this->min = null;
        }

        if (null !== $this->min && strtotime($this->min) === false) {
            $this->maxCheck = true;
            $this->maxName = $this->min;
            $this->max = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.date-picker');
    }
}
