<?php

namespace App\Filters;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CommentFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['expire_from'];

    protected function expire_from($date)
    {
        try {
            $realDate = Carbon::createFromFormat("|Y-m-d", $date);
        }
        catch (Exception $e) {
            Session::flash('alerts', [0 => ['message' => 'Felaktigt datumformat på parameter ('.$date.'), ska vara YYYY-mm-dd', 'class' => 'warning']]);
            $realDate = Carbon::now();
        }

        return $this->builder->where('expire_at', '>=', $realDate->toDateString());
    }

}