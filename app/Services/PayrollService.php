<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\SalaryAdjustment;
use Carbon\Carbon;

class PayrollService
{
    /**
     * Calculate gaji bersih untuk satu karyawan di periode tertentu
     */
    public function calculateEmployeeSalary(Employee $employee, int $bulan, int $tahun): array
    {
        // 1. Gaji Pokok
        $gajiPokok = $this->getBaseSalary($employee);

        // 2. Total Tunjangan
        $tunjangan = $this->getTotalAllowances($employee);

        // 3. Penyesuaian (Penambahan & Pengurangan)
        $penyesuaian = $this->getSalaryAdjustments($employee, $bulan, $tahun);

        // 4. Penghasilan Bruto
        $penghasilanBruto = $gajiPokok + $tunjangan + $penyesuaian['penambahan'];

        // 5. Potongan BPJS
        $bpjsKesehatan = $this->calculateBpjsHealth($employee);
        $bpjsKetenagakerjaan = $this->calculateBpjsEmployment($employee);

        // 6. Potongan Pajak PPh 21
        $pph21 = $this->calculatePph21($employee, $penghasilanBruto);

        // 7. Total Potongan
        $totalPotongan = $bpjsKesehatan['karyawan'] 
                       + $bpjsKetenagakerjaan['total_karyawan'] 
                       + $pph21 
                       + $penyesuaian['pengurangan'];

        // 8. Gaji Bersih (Take Home Pay)
        $gajiBersih = $penghasilanBruto - $totalPotongan;

        return [
            'employee_id' => $employee->id,
            'nik' => $employee->nik,
            'nama' => $employee->nama,
            'periode' => Carbon::create($tahun, $bulan)->format('F Y'),
            'bulan' => $bulan,
            'tahun' => $tahun,
            
            // Penghasilan
            'gaji_pokok' => $gajiPokok,
            'tunjangan' => $tunjangan,
            'tunjangan_detail' => $this->getAllowancesDetail($employee),
            'penyesuaian_penambahan' => $penyesuaian['penambahan'],
            'penyesuaian_pengurangan' => $penyesuaian['pengurangan'],
            'penghasilan_bruto' => $penghasilanBruto,
            
            // Potongan
            'bpjs_kesehatan_karyawan' => $bpjsKesehatan['karyawan'],
            'bpjs_kesehatan_perusahaan' => $bpjsKesehatan['perusahaan'],
            'bpjs_jht_karyawan' => $bpjsKetenagakerjaan['jht_karyawan'],
            'bpjs_jp_karyawan' => $bpjsKetenagakerjaan['jp_karyawan'],
            'bpjs_total_karyawan' => $bpjsKetenagakerjaan['total_karyawan'],
            'bpjs_jht_perusahaan' => $bpjsKetenagakerjaan['jht_perusahaan'],
            'bpjs_jp_perusahaan' => $bpjsKetenagakerjaan['jp_perusahaan'],
            'bpjs_jkk_perusahaan' => $bpjsKetenagakerjaan['jkk_perusahaan'],
            'bpjs_jkm_perusahaan' => $bpjsKetenagakerjaan['jkm_perusahaan'],
            'bpjs_total_perusahaan' => $bpjsKetenagakerjaan['total_perusahaan'],
            'pph21' => $pph21,
            'total_potongan' => $totalPotongan,
            
            // Final
            'gaji_bersih' => $gajiBersih,
        ];
    }

    /**
     * Get gaji pokok karyawan yang sedang aktif
     */
    private function getBaseSalary(Employee $employee): float
    {
        $baseSalary = $employee->currentBaseSalary;
        return $baseSalary ? $baseSalary->nominal : 0;
    }

    /**
     * Get total tunjangan aktif
     */
    private function getTotalAllowances(Employee $employee): float
    {
        return $employee->activeAllowances()->sum('nominal');
    }

    /**
     * Get detail tunjangan per jenis
     */
    private function getAllowancesDetail(Employee $employee): array
    {
        return $employee->activeAllowances()
            ->with('allowanceType')
            ->get()
            ->map(function($allowance) {
                return [
                    'nama' => $allowance->allowanceType->nama,
                    'nominal' => $allowance->nominal,
                ];
            })
            ->toArray();
    }

    /**
     * Get penyesuaian gaji untuk periode tertentu
     */
    private function getSalaryAdjustments(Employee $employee, int $bulan, int $tahun): array
    {
        $adjustment = SalaryAdjustment::forPeriod($bulan, $tahun)
            ->final()
            ->with(['details' => function($query) use ($employee) {
                $query->where('employee_id', $employee->id);
            }])
            ->first();

        if (!$adjustment || $adjustment->details->isEmpty()) {
            return [
                'penambahan' => 0,
                'pengurangan' => 0,
            ];
        }

        $detail = $adjustment->details->first();
        return [
            'penambahan' => $detail->nominal_penambahan ?? 0,
            'pengurangan' => $detail->nominal_pengurangan ?? 0,
        ];
    }

    /**
     * Calculate BPJS Kesehatan
     */
    private function calculateBpjsHealth(Employee $employee): array
    {
        $bpjs = $employee->bpjsHealth;
        
        if (!$bpjs) {
            return [
                'karyawan' => 0,
                'perusahaan' => 0,
            ];
        }

        return [
            'karyawan' => $bpjs->iuran_karyawan,
            'perusahaan' => $bpjs->iuran_perusahaan,
        ];
    }

    /**
     * Calculate BPJS Ketenagakerjaan
     */
    private function calculateBpjsEmployment(Employee $employee): array
    {
        $bpjs = $employee->bpjsEmployment;
        
        if (!$bpjs) {
            return [
                'jht_karyawan' => 0,
                'jp_karyawan' => 0,
                'total_karyawan' => 0,
                'jht_perusahaan' => 0,
                'jp_perusahaan' => 0,
                'jkk_perusahaan' => 0,
                'jkm_perusahaan' => 0,
                'total_perusahaan' => 0,
            ];
        }

        return [
            'jht_karyawan' => $bpjs->jht_karyawan,
            'jp_karyawan' => $bpjs->jp_karyawan,
            'total_karyawan' => $bpjs->jht_karyawan + $bpjs->jp_karyawan,
            'jht_perusahaan' => $bpjs->jht_perusahaan,
            'jp_perusahaan' => $bpjs->jp_perusahaan,
            'jkk_perusahaan' => $bpjs->jkk_perusahaan,
            'jkm_perusahaan' => $bpjs->jkm_perusahaan,
            'total_perusahaan' => $bpjs->jht_perusahaan + $bpjs->jp_perusahaan + $bpjs->jkk_perusahaan + $bpjs->jkm_perusahaan,
        ];
    }

    /**
     * Calculate PPh 21 (Simplified - bisa dikembangkan lebih detail)
     */
    private function calculatePph21(Employee $employee, float $penghasilanBruto): float
    {
        // Penghasilan per tahun
        $penghasilanTahunan = $penghasilanBruto * 12;

        // PTKP berdasarkan status perkawinan
        $ptkp = $this->getPtkp($employee->status_perkawinan);

        // Penghasilan Kena Pajak
        $pkp = $penghasilanTahunan - $ptkp;

        if ($pkp <= 0) {
            return 0;
        }

        // Hitung pajak progresif
        $pajak = 0;

        // Layer 1: 0 - 60jt (5%)
        if ($pkp > 60000000) {
            $pajak += 60000000 * 0.05;
            $pkp -= 60000000;
        } else {
            $pajak += $pkp * 0.05;
            return round($pajak / 12, 0); // PPh 21 per bulan
        }

        // Layer 2: 60jt - 250jt (15%)
        if ($pkp > 190000000) {
            $pajak += 190000000 * 0.15;
            $pkp -= 190000000;
        } else {
            $pajak += $pkp * 0.15;
            return round($pajak / 12, 0);
        }

        // Layer 3: 250jt - 500jt (25%)
        if ($pkp > 250000000) {
            $pajak += 250000000 * 0.25;
            $pkp -= 250000000;
        } else {
            $pajak += $pkp * 0.25;
            return round($pajak / 12, 0);
        }

        // Layer 4: 500jt - 5M (30%)
        if ($pkp > 4500000000) {
            $pajak += 4500000000 * 0.30;
            $pkp -= 4500000000;
        } else {
            $pajak += $pkp * 0.30;
            return round($pajak / 12, 0);
        }

        // Layer 5: > 5M (35%)
        $pajak += $pkp * 0.35;

        // Return PPh 21 per bulan
        return round($pajak / 12, 0);
    }

    /**
     * Get PTKP berdasarkan status perkawinan
     */
    private function getPtkp(string $status): float
    {
        $ptkpMap = [
            'TK/0' => 54000000,  // Tidak Kawin, 0 tanggungan
            'TK/1' => 58500000,
            'TK/2' => 63000000,
            'TK/3' => 67500000,
            'K/0'  => 58500000,  // Kawin, 0 tanggungan
            'K/1'  => 63000000,
            'K/2'  => 67500000,
            'K/3'  => 72000000,
        ];

        return $ptkpMap[$status] ?? 54000000;
    }

    /**
     * Calculate payroll untuk semua karyawan di cabang/departemen tertentu
     */
    public function calculateBulkPayroll(int $bulan, int $tahun, ?int $branchId = null, ?int $departmentId = null): array
    {
        $employees = Employee::active()
            ->with(['currentBaseSalary', 'activeAllowances', 'bpjsHealth', 'bpjsEmployment'])
            ->when($branchId, fn($q) => $q->byBranch($branchId))
            ->when($departmentId, fn($q) => $q->byDepartment($departmentId))
            ->get();

        $results = [];
        foreach ($employees as $employee) {
            $results[] = $this->calculateEmployeeSalary($employee, $bulan, $tahun);
        }

        return $results;
    }
}
