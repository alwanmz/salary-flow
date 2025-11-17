<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'nama_departemen' => 'IT & Technology',
                'deskripsi' => 'Department yang menangani teknologi informasi dan pengembangan sistem',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Human Resources',
                'deskripsi' => 'Department yang mengelola SDM dan kepegawaian',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Finance & Accounting',
                'deskripsi' => 'Department yang menangani keuangan dan akuntansi perusahaan',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Marketing & Sales',
                'deskripsi' => 'Department yang menangani pemasaran dan penjualan',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Operations',
                'deskripsi' => 'Department yang menangani operasional harian perusahaan',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Customer Service',
                'deskripsi' => 'Department yang menangani layanan pelanggan',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'Procurement',
                'deskripsi' => 'Department yang menangani pengadaan barang dan jasa',
                'is_active' => true,
            ],
            [
                'nama_departemen' => 'General Affairs',
                'deskripsi' => 'Department yang menangani urusan umum dan administrasi',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
