<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        User::create([
            'profile_id' => null,
            'name' => 'iPad',
            'email' => 'kansli@armagedon.se',
            'password' => Hash::make(Str::random(10)),
        ]);
        User::create([
            'profile_id' => 901,
            'name' => 'Örjan Almén',
            'email' => 'orjan.almen@gmail.com',
            'password' => Hash::make(Str::random(10)),
        ]);
        User::create([
            'profile_id' => 944,
            'name' => 'Niklas Mårdby',
            'email' => 'niklas.mardby@gmail.com',
            'password' => Hash::make(Str::random(10)), // Hash::make('password')
        ]);

        $permissionEdit = Permission::create(['name' => 'permissions-update', 'label' => 'Redigera rättigheter', 'group' => 'Rättigheter']);
        $admin = Role::create(['label' => 'Administratör', 'name' => 'admin']);
        $admin->givePermissionTo($permissionEdit);
        $guestRole = Role::create(['label' => 'Gäst/Ej inloggad', 'name' => 'guest']);
        $userRole = Role::create(['label' => 'Användare/Inloggad', 'name' => 'user']);
        Role::create(['label' => 'Styrelse', 'name' => 'board']);
        Role::create(['label' => 'Kassör', 'name' => 'cashier']);
        Role::create(['label' => 'iPad', 'name' => 'ipad']);
        User::find(1)->assignRole('ipad');
        User::find(2)->assignRole('admin');
        User::find(3)->assignRole('admin');
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
