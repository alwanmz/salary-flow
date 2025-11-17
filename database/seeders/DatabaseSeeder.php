<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Master Data (harus duluan)
        $this->call([
            BranchSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            LeaveTypeSeeder::class,
            WorkScheduleSeeder::class,
        ]);

        // User & Role (sebelum employee karena ada relasi)
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
        ]);

        // Payroll Module
        $this->call([
            AllowanceTypeSeeder::class,
            EmployeeSeeder::class,
            BaseSalarySeeder::class,
            AllowanceSeeder::class,
            BpjsHealthSeeder::class,
            BpjsEmploymentSeeder::class,
        ]);

        $this->command->info('🎉 All seeders completed successfully!');
    }
}
