<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAssignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userInfo = [
            ['name' => 'Super Admin', 'email' => 'superadmin@gmail.com', 'password' => Hash::make(12345678)],
            ['name' => 'Admin Member', 'email' => 'adminmember@gmail.com', 'parent_id' => '1', 'password' => Hash::make(12345678)]
        ];
        foreach ($userInfo as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );
        }
        // For Super Admin
        $role = Role::find(1);
        $user = User::find(1);
        if ($role && $user) {
            $user->assignRole($role);
        }
        //For Admin
        $role2 = Role::find(2);
        $user2 = User::find(2);
        if ($role2 && $user2) {
            $user2->assignRole($role2);
        }
    }
}
