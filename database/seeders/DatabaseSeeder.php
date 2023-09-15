<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'member' => 901,
            'name' => 'Örjan Almén',
            'email' => 'orjan.almen@gmail.com',
            'password' => Str::random(10),
        ]);
        User::create([
            'member' => 944,
            'name' => 'Niklas Mårdby',
            'email' => 'niklas.mardby@gmail.com',
            'password' => Str::random(10),
        ]);
        $this->call([
            PageSeeder::class,
        ]);

        $permissionEdit = Permission::create(['name' => 'permissions-update', 'label' => 'Redigera rättigheter', 'group' => 'Rättigheter']);
        $permissionInform = Permission::create(['name' => 'prospect-inform-converted']);
        $admin = Role::create(['label' => 'Administratör', 'name' => 'admin']);
        $guestRole = Role::create(['label' => 'Gäst/Ej inloggad', 'name' => 'guest']);
        $userRole = Role::create(['label' => 'Användare/Inloggad', 'name' => 'user']);
        $admin->givePermissionTo($permissionEdit);
        Role::create(['label' => 'Styrelse', 'name' => 'board']);
        Role::create(['label' => 'Kassör', 'name' => 'cashier']);
        Role::create(['label' => 'Bilvärd', 'name' => 'cars']);
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('admin');
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
