<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define all permissions
        $permissions = [
            // Student permissions
            'view_departments',
            'view_programs',
            'view_faculty',
            'view_research',
            'view_news',
            'view_student_dashboard',

            // Admin permissions
            'manage_departments',
            'manage_programs',
            'manage_faculty',
            'manage_research',
            'manage_news',
            'view_students',
            'view_admin_dashboard',

            // Superadmin permissions
            'manage_admins',
            'manage_roles',
            'manage_permissions',
            'manage_settings',
            'full_access',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $studentRole->syncPermissions([
            'view_departments',
            'view_programs',
            'view_faculty',
            'view_research',
            'view_news',
            'view_student_dashboard',
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([
            'view_departments',
            'view_programs',
            'view_faculty',
            'view_research',
            'view_news',
            'view_student_dashboard',
            'manage_departments',
            'manage_programs',
            'manage_faculty',
            'manage_research',
            'manage_news',
            'view_students',
            'view_admin_dashboard',
        ]);

        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $superadminRole->syncPermissions(Permission::all());
    }
}
