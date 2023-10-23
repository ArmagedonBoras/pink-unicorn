<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::createMany(['cash' => 'Kontant', 'card' => 'Kort', 'wire' => 'Bankgiro', 'mobile' => 'Swish',], 'payments.methods');
        Tag::createMany(['owner' => 'Bokare', 'org' => 'Medarrangör', 'part' => 'Deltagare'], 'events.roles');
        Tag::createMany(['open' => 'Öppen (även ej medlemmar)', 'members' => 'Endast medlemmar', 'closed' => 'Sluten grupp', 'blocked' => 'Ej bokningsbar tid',], 'events.avaliablility');
        Tag::createMany(['room' => 'Enstaka rum', 'building' => 'Hela lokalen', 'external' => 'Extern bokning',], 'events.scope');
        Tag::createMany(['hidden' => 'Endast bokning', 'open' => 'Endast medlemmar', 'public' => 'Publik', 'advertized' => 'Marknadsfört'], 'events.visibility');
        Tag::createMany(['none' => 'Häng i lokalen', 'org' => 'Organisationsutveckling', 'hobby' => 'Hobby/Målning', 'board' => 'Brädspel', 'card' => 'Kortspel', 'figure' => 'figurspel'], 'events.activity_type');
        Tag::createMany(['any' => 'Generellt', 'board' => 'Styrelsemöte', 'ass' => 'Föreningsmöte', 'bsk' => 'BSK-möte', 'work' => 'Arbete i lokalen'], 'events.activity_org');

        Tag::createMany(['any' => 'Generellt/Blandat'], 'events.activity_board');
        Tag::createMany(['any' => 'Generellt/Blandat'], 'events.activity_card');
        Tag::createMany(['any' => 'Generellt/Blandat'], 'events.activity_hobby');
        Tag::createMany(['any' => 'Generellt/Blandat'], 'events.activity_figure');
    }
}
