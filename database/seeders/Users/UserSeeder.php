<?php

namespace Database\Seeders\Users;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view_user',
            'create_user',
            'update_user',
            'delete_user',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm],
                ['group' => 'users_management']
            );
        }

        // 2) Crear rol
        $role = Role::firstOrCreate(['name' => 'admin']);

        // 3) Asignar permisos al rol
        $role->syncPermissions($permissions);

        // 4) Crear 20 usuarios y asignar rol + permisos
        User::factory()->count(20)->create()->each(function ($user) use ($role) {
            $user->assignRole($role);
        });

        // Usuario admin opcional (por si quieres acceso directo)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        )->assignRole($role);
    }
}
