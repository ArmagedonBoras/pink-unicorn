<?php

namespace Database\Factories;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = $this->faker->dateTimeBetween('-3 weeks', '+3 weeks');
        $c = new Carbon($fake);
        $c->second = 0;
        $c->minute = 0;
        $starts_at = new Carbon($c);
        $c->hour = 6;
        $c->addDay();
        return [
                'owner' => User::inRandomOrder()->first()->id,
                'starts_at' => $starts_at,
                'ends_at' => $c,
        ];
    }
}
