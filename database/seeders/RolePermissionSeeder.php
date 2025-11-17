<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Employee Management
            'view_employees',
            'create_employees',
            'edit_employees',
            'delete_employees',
            'import_employees',
            
            // Master Data
            'manage_branches',
            'manage_departments',
            'manage_positions',
            'manage_leave_types',
            'manage_work_schedules',
            
            // Payroll
            'view_payroll',
            'manage_base_salaries',
            'manage_allowances',
            'manage_allowance_types',
            'manage_bpjs',
            'manage_salary_adjustments',
            'generate_payroll',
            
            // Leave Requests
            'view_own_leave_requests',
            'create_leave_requests',
            'view_all_leave_requests',
            'approve_leave_requests',
            'reject_leave_requests',
            
            // Attendance
            'view_own_attendance',
            'create_attendance',
            'view_all_attendance',
            'manage_attendance',
            
            // Reports
            'view_salary_reports',
            'view_payslips',
            'view_own_payslip',
            'generate_reports',
            
            // Users & Roles
            'manage_users',
            'manage_roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles and Assign Permissions
        
        // Super Admin - All permissions
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin Payroll/HRD
        $adminPayroll = Role::create(['name' => 'admin_payroll']);
        $adminPayroll->givePermissionTo([
            'view_employees', 'create_employees', 'edit_employees', 'delete_employees', 'import_employees',
            'manage_branches', 'manage_departments', 'manage_positions', 'manage_leave_types', 'manage_work_schedules',
            'view_payroll', 'manage_base_salaries', 'manage_allowances', 'manage_allowance_types', 'manage_bpjs', 'manage_salary_adjustments', 'generate_payroll',
            'view_all_leave_requests', 'approve_leave_requests', 'reject_leave_requests',
            'view_all_attendance', 'manage_attendance',
            'view_salary_reports', 'view_payslips', 'generate_reports',
        ]);

        // Manager/Supervisor
        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'view_employees',
            'view_all_leave_requests', 'approve_leave_requests', 'reject_leave_requests',
            'view_all_attendance',
            'view_salary_reports',
        ]);

        // Employee/User
        $employee = Role::create(['name' => 'employee']);
        $employee->givePermissionTo([
            'view_own_leave_requests', 'create_leave_requests',
            'view_own_attendance', 'create_attendance',
            'view_own_payslip',
        ]);
    }
}
