<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Gate;
use App\View\Components\FormComponent;

class BookingDateHourPicker extends FormComponent
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
            $this->min = (Gate::allows('bookings-before-today') ? now()->subMonths(5)->format('Y-m-d').' 00:00:00' : now()->format('Y-m-d H').':00:00');
        } else {
            $this->min = $this->min ?? (Gate::allows('bookings-before-today') ? now()->subMonths(5)->format('Y-m-d').' 00:00:00' : now()->format('Y-m-d H').':00:00');
        }

        if (null !== $this->min && strtotime($this->min) === false) {
            $this->maxCheck = true;
            $this->maxName = $this->min;
            $this->max = now()->addMonths(9)->format('Y-m-d');
        } else {
            $this->max = $this->max ?? now()->addMonths(9)->format('Y-m-d');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.booking-date-hour-picker');
    }
}
