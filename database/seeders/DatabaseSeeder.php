<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\UserSeeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
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

        ]);
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
