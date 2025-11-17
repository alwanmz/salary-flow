<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\AllowanceType;
use App\Models\Allowance;

class AllowanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $allowanceTypes = AllowanceType::all();

        foreach ($employees as $employee) {
            $level = $employee->position->level ?? 5;

            // Tunjangan Transport (semua karyawan)
            $transportType = $allowanceTypes->where('nama', 'Tunjangan Transport')->first();
            if ($transportType) {
                Allowance::create([
                    'employee_id' => $employee->id,
                    'allowance_type_id' => $transportType->id,
                    'nominal' => match($level) {
                        1, 2 => 2000000,
                        3 => 1500000,
                        4 => 1000000,
                        default => 750000,
                    },
                    'tanggal_berlaku' => $employee->tanggal_masuk,
                    'is_active' => true,
                ]);
            }

            // Tunjangan Makan (semua karyawan)
            $makanType = $allowanceTypes->where('nama', 'Tunjangan Makan')->first();
            if ($makanType) {
                Allowance::create([
                    'employee_id' => $employee->id,
                    'allowance_type_id' => $makanType->id,
                    'nominal' => 1000000, // Flat untuk semua
                    'tanggal_berlaku' => $employee->tanggal_masuk,
                    'is_active' => true,
                ]);
            }

            // Tunjangan Komunikasi (level 1-4 saja)
            if ($level <= 4) {
                $komType = $allowanceTypes->where('nama', 'Tunjangan Komunikasi')->first();
                if ($komType) {
                    Allowance::create([
                        'employee_id' => $employee->id,
                        'allowance_type_id' => $komType->id,
                        'nominal' => match($level) {
                            1 => 1500000,
                            2 => 1000000,
                            3 => 750000,
                            4 => 500000,
                            default => 300000,
                        },
                        'tanggal_berlaku' => $employee->tanggal_masuk,
                        'is_active' => true,
                    ]);
                }
            }

            // Tunjangan Jabatan (level 1-3 saja)
            if ($level <= 3) {
                $jabatanType = $allowanceTypes->where('nama', 'Tunjangan Jabatan')->first();
                if ($jabatanType) {
                    Allowance::create([
                        'employee_id' => $employee->id,
                        'allowance_type_id' => $jabatanType->id,
                        'nominal' => match($level) {
                            1 => 5000000,
                            2 => 3000000,
                            3 => 2000000,
                            default => 0,
                        },
                        'tanggal_berlaku' => $employee->tanggal_masuk,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
