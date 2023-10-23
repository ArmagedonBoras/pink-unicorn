<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LinksSeeder extends Seeder
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
    }
}
