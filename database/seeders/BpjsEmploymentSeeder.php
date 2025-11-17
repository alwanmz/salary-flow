<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\BpjsEmployment;

class BpjsEmploymentSeeder extends Seeder
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
            
            // Upah untuk BPJS Ketenagakerjaan (tidak ada batasan max)
            $upahBpjs = $gajiPokok;
            
            // JHT (Jaminan Hari Tua)
            $jhtPerusahaan = $upahBpjs * 0.037; // 3.7%
            $jhtKaryawan = $upahBpjs * 0.02;    // 2%
            
            // JP (Jaminan Pensiun) - max dari 10.042.300
            $upahJp = min($upahBpjs, 10042300);
            $jpPerusahaan = $upahJp * 0.02;     // 2%
            $jpKaryawan = $upahJp * 0.01;       // 1%
            
            // JKK (Jaminan Kecelakaan Kerja) - perusahaan only
            // Asumsi risiko rendah = 0.24%
            $jkkPerusahaan = $upahBpjs * 0.0024;
            
            // JKM (Jaminan Kematian) - perusahaan only
            $jkmPerusahaan = $upahBpjs * 0.003; // 0.3%

            BpjsEmployment::create([
                'employee_id' => $employee->id,
                'nomor_bpjs' => '0002' . str_pad($employee->id, 8, '0', STR_PAD_LEFT),
                'upah_untuk_bpjs' => $upahBpjs,
                'jht_perusahaan' => $jhtPerusahaan,
                'jht_karyawan' => $jhtKaryawan,
                'jp_perusahaan' => $jpPerusahaan,
                'jp_karyawan' => $jpKaryawan,
                'jkk_perusahaan' => $jkkPerusahaan,
                'jkm_perusahaan' => $jkmPerusahaan,
                'tanggal_berlaku' => $employee->tanggal_masuk,
                'is_active' => true,
            ]);
        }
    }
}
