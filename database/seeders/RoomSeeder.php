<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
                'maintained_by' => 1,
                'name' => 'Stora rummet',
                'short' => 'Stora',
                'color' => "#aaaaaa",
                'text_color' => '#000000',
                'bookable' => true,
                'icon' => 'dice-1',
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Gröna rummet',
                'short' => 'Gröna',
                'color' => "#00ff00",
                'text_color' => '#000000',
                'bookable' => true,
                'icon' => 'dice-2',
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Blå rummet',
                'short' => 'Blå',
                'color' => "#0000ff",
                'text_color' => '#ffffff',
                'bookable' => true,
                'icon' => 'dice-3',
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Röda rummet',
                'short' => 'Röda',
                'color' => "#ff0000",
                'text_color' => '#000000',
                'bookable' => true,
                'icon' => 'dice-4',
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Bruna rummet',
                'short' => 'Bruna',
                'color' => "#a52a2a",
                'text_color' => '#ffffff',
                'bookable' => true,
                'icon' => 'dice-5',
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Målarhörnan',
                'short' => 'Målarhörnan',
                'color' => "#ffffff",
                'text_color' => '#000000',
                'bookable' => false,
        ]);
        Room::create([
                'maintained_by' => 1,
                'name' => 'Sprayrummet',
                'short' => 'Spray',
                'color' => "#ffffff",
                'text_color' => '#000000',
                'bookable' => false,
        ]);
    }
}
