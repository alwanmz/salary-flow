<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\BaseSalary;

class BaseSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Tentukan gaji berdasarkan posisi level
            $level = $employee->position->level ?? 5;
            
            $baseSalary = match($level) {
                1 => rand(25000000, 50000000), // C-Level
                2 => rand(15000000, 25000000), // Manager
                3 => rand(10000000, 15000000), // Supervisor
                4 => rand(7000000, 10000000),  // Senior Staff
                5 => rand(5000000, 7000000),   // Staff
                6 => rand(4000000, 5000000),   // Junior Staff
                7 => rand(3500000, 4500000),   // Support
                default => rand(4500000, 6000000),
            };

            BaseSalary::create([
                'employee_id' => $employee->id,
                'nominal' => $baseSalary,
                'tanggal_berlaku' => $employee->tanggal_masuk,
                'tanggal_berakhir' => null,
                'keterangan' => 'Gaji pokok initial',
                'is_active' => true,
            ]);
        }
    }
}
