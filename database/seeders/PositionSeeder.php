<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            // Management Level
            ['nama_jabatan' => 'Chief Executive Officer (CEO)', 'level' => 1, 'deskripsi' => 'Pimpinan tertinggi perusahaan'],
            ['nama_jabatan' => 'Chief Operating Officer (COO)', 'level' => 1, 'deskripsi' => 'Direktur operasional'],
            ['nama_jabatan' => 'Chief Financial Officer (CFO)', 'level' => 1, 'deskripsi' => 'Direktur keuangan'],
            ['nama_jabatan' => 'Chief Technology Officer (CTO)', 'level' => 1, 'deskripsi' => 'Direktur teknologi'],
            
            // Manager Level
            ['nama_jabatan' => 'General Manager', 'level' => 2, 'deskripsi' => 'Manajer umum cabang'],
            ['nama_jabatan' => 'IT Manager', 'level' => 2, 'deskripsi' => 'Manajer IT'],
            ['nama_jabatan' => 'HR Manager', 'level' => 2, 'deskripsi' => 'Manajer HRD'],
            ['nama_jabatan' => 'Finance Manager', 'level' => 2, 'deskripsi' => 'Manajer keuangan'],
            ['nama_jabatan' => 'Marketing Manager', 'level' => 2, 'deskripsi' => 'Manajer pemasaran'],
            ['nama_jabatan' => 'Operations Manager', 'level' => 2, 'deskripsi' => 'Manajer operasional'],
            
            // Supervisor Level
            ['nama_jabatan' => 'Supervisor', 'level' => 3, 'deskripsi' => 'Pengawas tim'],
            ['nama_jabatan' => 'Team Leader', 'level' => 3, 'deskripsi' => 'Pemimpin tim'],
            
            // Staff Level
            ['nama_jabatan' => 'Senior Staff', 'level' => 4, 'deskripsi' => 'Staf senior'],
            ['nama_jabatan' => 'Staff', 'level' => 5, 'deskripsi' => 'Staf regular'],
            ['nama_jabatan' => 'Junior Staff', 'level' => 6, 'deskripsi' => 'Staf junior'],
            
            // Specialist
            ['nama_jabatan' => 'Programmer', 'level' => 5, 'deskripsi' => 'Programmer aplikasi'],
            ['nama_jabatan' => 'System Analyst', 'level' => 4, 'deskripsi' => 'Analis sistem'],
            ['nama_jabatan' => 'Accountant', 'level' => 5, 'deskripsi' => 'Akuntan'],
            ['nama_jabatan' => 'Marketing Executive', 'level' => 5, 'deskripsi' => 'Eksekutif pemasaran'],
            
            // Support
            ['nama_jabatan' => 'Admin', 'level' => 6, 'deskripsi' => 'Staff administrasi'],
            ['nama_jabatan' => 'Receptionist', 'level' => 6, 'deskripsi' => 'Staff resepsionis'],
            ['nama_jabatan' => 'Driver', 'level' => 7, 'deskripsi' => 'Supir'],
            ['nama_jabatan' => 'Office Boy', 'level' => 7, 'deskripsi' => 'Office boy/cleaning service'],
        ];

        foreach ($positions as $position) {
            Position::create([
                'nama_jabatan' => $position['nama_jabatan'],
                'level' => $position['level'],
                'deskripsi' => $position['deskripsi'] ?? null,
                'is_active' => true,
            ]);
        }
    }
}
