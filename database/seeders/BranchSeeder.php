<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'nama_cabang' => 'Kantor Pusat Jakarta',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Selatan',
                'telepon' => '021-5551234',
                'lokasi' => 'Plaza Sudirman Lt. 10',
                'latitude' => -6.208763,
                'longitude' => 106.845599,
                'radius' => 100,
                'is_active' => true,
            ],
            [
                'nama_cabang' => 'Cabang Bandung',
                'alamat' => 'Jl. Asia Afrika No. 45, Bandung',
                'telepon' => '022-4441234',
                'lokasi' => 'Gedung Sate Complex',
                'latitude' => -6.921474,
                'longitude' => 107.619123,
                'radius' => 150,
                'is_active' => true,
            ],
            [
                'nama_cabang' => 'Cabang Surabaya',
                'alamat' => 'Jl. Tunjungan No. 78, Surabaya',
                'telepon' => '031-5551234',
                'lokasi' => 'Tunjungan Plaza Area',
                'latitude' => -7.257472,
                'longitude' => 112.752090,
                'radius' => 120,
                'is_active' => true,
            ],
            [
                'nama_cabang' => 'Cabang Medan',
                'alamat' => 'Jl. Gatot Subroto No. 56, Medan',
                'telepon' => '061-4441234',
                'lokasi' => 'Sun Plaza Area',
                'latitude' => 3.595196,
                'longitude' => 98.672223,
                'radius' => 100,
                'is_active' => true,
            ],
            [
                'nama_cabang' => 'Cabang Semarang',
                'alamat' => 'Jl. Pemuda No. 34, Semarang',
                'telepon' => '024-3331234',
                'lokasi' => 'Simpang Lima Area',
                'latitude' => -6.966667,
                'longitude' => 110.416664,
                'radius' => 100,
                'is_active' => true,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
