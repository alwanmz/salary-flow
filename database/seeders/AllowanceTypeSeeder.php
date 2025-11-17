<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AllowanceType;

class AllowanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allowanceTypes = [
            [
                'nama' => 'Tunjangan Transport',
                'deskripsi' => 'Tunjangan transportasi karyawan',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Makan',
                'deskripsi' => 'Tunjangan makan harian',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Komunikasi',
                'deskripsi' => 'Tunjangan pulsa dan komunikasi',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Jabatan',
                'deskripsi' => 'Tunjangan sesuai jabatan',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Kehadiran',
                'deskripsi' => 'Tunjangan kehadiran penuh',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Kinerja',
                'deskripsi' => 'Tunjangan berdasarkan kinerja',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Hari Raya (THR)',
                'deskripsi' => 'Tunjangan Hari Raya keagamaan',
                'is_taxable' => true,
            ],
            [
                'nama' => 'Tunjangan Kesehatan',
                'deskripsi' => 'Tunjangan kesehatan tambahan',
                'is_taxable' => false,
            ],
            [
                'nama' => 'Tunjangan Pendidikan',
                'deskripsi' => 'Tunjangan untuk pendidikan anak',
                'is_taxable' => false,
            ],
            [
                'nama' => 'Tunjangan Lembur',
                'deskripsi' => 'Tunjangan jam kerja lembur',
                'is_taxable' => true,
            ],
        ];

        foreach ($allowanceTypes as $type) {
            AllowanceType::create([
                'nama' => $type['nama'],
                'deskripsi' => $type['deskripsi'],
                'is_taxable' => $type['is_taxable'],
                'is_active' => true,
            ]);
        }
    }
}
