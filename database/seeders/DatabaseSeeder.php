<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\LinkSeeder;
use Database\Seeders\TabletSeeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\ArticleSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\WaitingListSeeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            RoomSeeder::class,
            // EventSeeder::class,
            TagSeeder::class,
            TabletSeeder::class,
            WaitingListSeeder::class,
            //ArticleSeeder::class,
            LinkSeeder::class,
        ]);
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
