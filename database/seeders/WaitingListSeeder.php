<?php

namespace Database\Seeders;

use App\Models\WaitingList;
use App\Models\WaitingListObject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaitingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $small = WaitingListObject::create(
            ['name' => 'Stort skåp']
        );
        $big = WaitingListObject::create(
            ['name' => 'Litet skåp']
        );
        WaitingList::create([
            'user_id' => 2,
            'waiting_list_object_id' => 1,
        ]);


    }
}
