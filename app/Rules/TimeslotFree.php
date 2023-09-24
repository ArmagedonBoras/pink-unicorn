<?php

namespace App\Rules;

use Closure;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Booking;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeslotFree implements ValidationRule, DataAwareRule
{
    protected $data = [];

    public function validate($attribute, $value, Closure $fail): void
    {
        $starts_at = Carbon::parse($this->data['starts_at'])->addSecond();
        $ends_at = Carbon::parse($this->data['ends_at'])->subSecond();
        $room_id = $this->data['room_id'];
        $id = $this->data['id'] ?? 0;

        $events = DB::select(
            "SELECT * FROM events e
            JOIN event_room er ON e.id=er.room_id
            WHERE (? BETWEEN starts_at AND ends_at
            OR ? BETWEEN starts_at AND ends_at
            OR starts_at BETWEEN ? AND ?
            OR ends_at BETWEEN ? AND ?)
            AND room_id=?
            AND id <> ?",
            [$starts_at, $ends_at, $starts_at, $ends_at, $starts_at, $ends_at, $room_id, $id]
        );
        if (count($events) > 0) {
            $fail('Det finns redan en bokning under den önskade tiden');
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

}
