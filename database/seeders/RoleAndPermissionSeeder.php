<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions if they don't exist
        Permission::firstOrCreate(['name' => 'manage courses']);
        Permission::firstOrCreate(['name' => 'view courses']);
        Permission::firstOrCreate(['name' => 'enroll courses']);
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'edit users']);
        Permission::firstOrCreate(['name' => 'delete users']);
        Permission::firstOrCreate(['name' => 'approve courses']);
        Permission::firstOrCreate(['name'=> 'create courses']);
        Permission::firstOrCreate(['name'=> 'delete courses']);

        // Create roles if they don't exist
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $student = Role::firstOrCreate(['name' => 'student']);

        // Assign permissions to roles
        $admin->givePermissionTo([
            'manage courses', 'view courses',
            'enroll courses', 'manage users', 'view users',
            'edit users', 'delete users', 'approve courses'
        ]);

        $teacher->givePermissionTo([
            'create courses', 'delete courses',
            'manage courses', 'view courses', 'enroll courses'
        ]);

        $student->givePermissionTo([
            'view courses', 'enroll courses'
        ]);
    }
}
