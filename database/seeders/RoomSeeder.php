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
                'owner' => 1,
                'name' => 'Stora rummet',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Gröna rummet',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Blå rummet',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Röda rummet',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Bruna rummet',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Målarhörnan',
            ]);
        Room::create([
                'owner' => 1,
                'name' => 'Sprayrummet',
            ]);
    }
}
