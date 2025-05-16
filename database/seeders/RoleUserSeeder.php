<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $users = User::all();

        // Gán vai trò cho người dùng
        $users->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random()->id
            );
        });
    }
}
