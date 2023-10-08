<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TabletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ideaMenu = Menu::create(['name' => 'Hem', 'link' => 'tablet', 'sort_order' => 10, 'icon' => 'house', 'parent' => 'tablet']);
    }
}
