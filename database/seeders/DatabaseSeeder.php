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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        User::create([
            'memberNo' => 901,
            'name' => 'Örjan Almén',
            'email' => 'orjan.almen@gmail.com',
            'password' => Str::random(10), // Hash::make('password')
        ]);
        User::create([
            'memberNo' => 944,
            'name' => 'Niklas Mårdby',
            'email' => 'niklas.mardby@gmail.com',
            'password' => Hash::make(Str::random(10)), // Hash::make('password')
        ]);
        $this->call([
            PageSeeder::class,
        ]);

        $permissionEdit = Permission::create(['name' => 'permissions-update', 'label' => 'Redigera rättigheter', 'group' => 'Rättigheter']);
        $admin = Role::create(['label' => 'Administratör', 'name' => 'admin']);
        $admin->givePermissionTo($permissionEdit);
        $guestRole = Role::create(['label' => 'Gäst/Ej inloggad', 'name' => 'guest']);
        $userRole = Role::create(['label' => 'Användare/Inloggad', 'name' => 'user']);
        Role::create(['label' => 'Styrelse', 'name' => 'board']);
        Role::create(['label' => 'Kassör', 'name' => 'cashier']);
        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('admin');
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
