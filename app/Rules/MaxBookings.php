<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxBookings implements ValidationRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function validate($attribute, $value, Closure $fail): void
    {
        $user = auth()->user();
        $events = Event::where('starts_at', '>', Carbon::today()->addDay())->where('owned_by', $user->member_id)->get();
        if ($events->count() >= $user->profile->max_bookings) {
            $fail('Användaren har redan max antal bokningar');

        }
    }
}
