<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\BpjsHealth;

class BpjsHealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Ambil gaji pokok untuk perhitungan BPJS
            $baseSalary = $employee->currentBaseSalary;
            if (!$baseSalary) continue;

            $gajiPokok = $baseSalary->nominal;
            
            // BPJS Kesehatan max dari 12 juta
            $upahBpjs = min($gajiPokok, 12000000);
            
            // Iuran BPJS Kesehatan
            $iuranPerusahaan = $upahBpjs * 0.04; // 4%
            $iuranKaryawan = $upahBpjs * 0.01;   // 1%

            BpjsHealth::create([
                'employee_id' => $employee->id,
                'nomor_bpjs' => '0001' . str_pad($employee->id, 8, '0', STR_PAD_LEFT),
                'kelas' => rand(1, 3), // Random kelas 1-3
                'upah_untuk_bpjs' => $upahBpjs,
                'iuran_perusahaan' => $iuranPerusahaan,
                'iuran_karyawan' => $iuranKaryawan,
                'tanggal_berlaku' => $employee->tanggal_masuk,
                'is_active' => true,
            ]);
        }
    }
}
