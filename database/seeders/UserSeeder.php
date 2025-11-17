<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'email' => 'superadmin@payroll.com',
            'password' => Hash::make('password'),
            'branch_id' => 1, // Kantor Pusat
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin Payroll
        $adminPayroll = User::create([
            'name' => 'Admin HRD',
            'username' => 'admin_hrd',
            'email' => 'hrd@payroll.com',
            'password' => Hash::make('password'),
            'branch_id' => 1,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $adminPayroll->assignRole('admin_payroll');

        // Manager Jakarta
        $managerJkt = User::create([
            'name' => 'Manager Jakarta',
            'username' => 'manager_jkt',
            'email' => 'manager.jkt@payroll.com',
            'password' => Hash::make('password'),
            'branch_id' => 1,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $managerJkt->assignRole('manager');

        // Manager Bandung
        $managerBdg = User::create([
            'name' => 'Manager Bandung',
            'username' => 'manager_bdg',
            'email' => 'manager.bdg@payroll.com',
            'password' => Hash::make('password'),
            'branch_id' => 2,
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
        $managerBdg->assignRole('manager');

        // Sample Employees
        for ($i = 1; $i <= 5; $i++) {
            $employee = User::create([
                'name' => 'Employee ' . $i,
                'username' => 'employee' . $i,
                'email' => 'employee' . $i . '@payroll.com',
                'password' => Hash::make('password'),
                'branch_id' => rand(1, 5),
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $employee->assignRole('employee');
        }
    }
}
