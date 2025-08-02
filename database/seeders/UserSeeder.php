<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234567890',
            'user_type' => 'admin'
        ]);

        $role = Role::create([
            'name' => 'superadmin',
        ]);

        $permissions = Permission::pluck('id');

        $role->syncPermissions($permissions);

        $user->assignRole($role);

    }
}
