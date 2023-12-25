<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Link::create([
            'url' => 'https://discord.gg/DgbteVCtsh',
            'name' => 'Vår Discordserver',
            'icon' => 'discord',
        ]);
        Link::create([
            'url' => 'https://www.facebook.com/groups/armagedonboras',
            'name' => 'Vår Facebook',
            'icon' => 'facebook',
        ]);
    }
}
