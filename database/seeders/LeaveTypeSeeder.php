<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveTypes = [
            [
                'jenis_cuti' => 'Cuti Tahunan',
                'jumlah_hari' => 12,
                'keterangan' => 'Cuti tahunan sesuai UU Ketenagakerjaan',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Sakit',
                'jumlah_hari' => 0,
                'keterangan' => 'Cuti sakit dengan surat dokter',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Melahirkan',
                'jumlah_hari' => 90,
                'keterangan' => 'Cuti melahirkan 3 bulan untuk karyawan perempuan',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Menikah',
                'jumlah_hari' => 3,
                'keterangan' => 'Cuti untuk pernikahan karyawan',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Kematian Keluarga',
                'jumlah_hari' => 2,
                'keterangan' => 'Cuti karena kematian anggota keluarga inti',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Khitanan/Baptis Anak',
                'jumlah_hari' => 2,
                'keterangan' => 'Cuti untuk acara khitanan atau baptis anak',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Menikahkan Anak',
                'jumlah_hari' => 2,
                'keterangan' => 'Cuti untuk menikahkan anak',
                'is_paid' => true,
                'requires_approval' => true,
            ],
            [
                'jenis_cuti' => 'Cuti Haji/Umroh',
                'jumlah_hari' => 30,
                'keterangan' => 'Cuti untuk ibadah haji atau umroh',
                'is_paid' => false,
                'requires_approval' => true,
            ],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create([
                'jenis_cuti' => $leaveType['jenis_cuti'],
                'jumlah_hari' => $leaveType['jumlah_hari'],
                'keterangan' => $leaveType['keterangan'],
                'is_paid' => $leaveType['is_paid'],
                'requires_approval' => $leaveType['requires_approval'],
                'is_active' => true,
            ]);
        }
    }
}
