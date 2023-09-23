<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Faker\Generator;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory(50)->create();
        $rooms = Room::where('bookable', true)->inRandomOrder()->get();
        foreach($events as $event) {
            $event->rooms()->syncWithoutDetaching($rooms->random());
            if ($event->id > 30) {
                $event->rooms()->syncWithoutDetaching($rooms->random());
            }
            if ($event->id > 40) {
                $event->rooms()->syncWithoutDetaching($rooms->random());
            }
        }
    }
}
