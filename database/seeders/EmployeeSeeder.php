<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Position;
use App\Models\WorkSchedule;
use App\Models\User;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale

        // Get IDs untuk foreign keys
        $branches = Branch::pluck('id')->toArray();
        $departments = Department::pluck('id')->toArray();
        $positions = Position::pluck('id')->toArray();
        $workSchedules = WorkSchedule::pluck('id')->toArray();
        $users = User::role('employee')->pluck('id')->toArray();

        // Data karyawan realistis
        $employees = [
            [
                'nik' => 'EMP001',
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-05-15',
                'alamat' => 'Jl. Melati No. 123, Jakarta Selatan',
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567890',
                'status_perkawinan' => 'K/1',
                'email' => 'budi.santoso@company.com',
                'status_karyawan' => 'tetap',
                'tanggal_masuk' => '2020-01-10',
            ],
            [
                'nik' => 'EMP002',
                'nama' => 'Siti Nurhaliza',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1992-08-20',
                'alamat' => 'Jl. Anggrek No. 45, Bandung',
                'jenis_kelamin' => 'P',
                'no_hp' => '081234567891',
                'status_perkawinan' => 'TK/0',
                'email' => 'siti.nurhaliza@company.com',
                'status_karyawan' => 'tetap',
                'tanggal_masuk' => '2019-03-15',
            ],
            [
                'nik' => 'EMP003',
                'nama' => 'Ahmad Fauzi',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1988-12-10',
                'alamat' => 'Jl. Mawar No. 78, Surabaya',
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567892',
                'status_perkawinan' => 'K/2',
                'email' => 'ahmad.fauzi@company.com',
                'status_karyawan' => 'tetap',
                'tanggal_masuk' => '2018-06-01',
            ],
            [
                'nik' => 'EMP004',
                'nama' => 'Dewi Lestari',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1995-03-25',
                'alamat' => 'Jl. Kenanga No. 90, Medan',
                'jenis_kelamin' => 'P',
                'no_hp' => '081234567893',
                'status_perkawinan' => 'K/0',
                'email' => 'dewi.lestari@company.com',
                'status_karyawan' => 'kontrak',
                'tanggal_masuk' => '2023-01-15',
            ],
            [
                'nik' => 'EMP005',
                'nama' => 'Rizky Pratama',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1993-07-18',
                'alamat' => 'Jl. Dahlia No. 34, Semarang',
                'jenis_kelamin' => 'L',
                'no_hp' => '081234567894',
                'status_perkawinan' => 'TK/0',
                'email' => 'rizky.pratama@company.com',
                'status_karyawan' => 'tetap',
                'tanggal_masuk' => '2021-09-20',
            ],
        ];

        foreach ($employees as $index => $empData) {
            Employee::create([
                'nik' => $empData['nik'],
                'nama' => $empData['nama'],
                'tempat_lahir' => $empData['tempat_lahir'],
                'tanggal_lahir' => $empData['tanggal_lahir'],
                'alamat' => $empData['alamat'],
                'jenis_kelamin' => $empData['jenis_kelamin'],
                'no_hp' => $empData['no_hp'],
                'status_perkawinan' => $empData['status_perkawinan'],
                'branch_id' => $branches[array_rand($branches)],
                'department_id' => $departments[array_rand($departments)],
                'position_id' => $positions[array_rand($positions)],
                'work_schedule_id' => $workSchedules[0], // Regular office hours
                'tanggal_masuk' => $empData['tanggal_masuk'],
                'status_karyawan' => $empData['status_karyawan'],
                'email' => $empData['email'],
                'user_id' => isset($users[$index]) ? $users[$index] : null,
                'is_active' => true,
            ]);
        }

        // Generate tambahan 15 karyawan random
        for ($i = 6; $i <= 20; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $firstName = $gender === 'L' ? $faker->firstNameMale : $faker->firstNameFemale;
            
            Employee::create([
                'nik' => 'EMP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => $firstName . ' ' . $faker->lastName,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '-25 years'),
                'alamat' => $faker->address,
                'jenis_kelamin' => $gender,
                'no_hp' => '08' . $faker->numerify('##########'),
                'status_perkawinan' => $faker->randomElement(['TK/0', 'TK/1', 'K/0', 'K/1', 'K/2']),
                'branch_id' => $branches[array_rand($branches)],
                'department_id' => $departments[array_rand($departments)],
                'position_id' => $positions[array_rand($positions)],
                'work_schedule_id' => $workSchedules[array_rand($workSchedules)],
                'tanggal_masuk' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'status_karyawan' => $faker->randomElement(['tetap', 'kontrak', 'probation']),
                'email' => strtolower(str_replace(' ', '.', $firstName . '.' . $faker->lastName)) . '@company.com',
                'is_active' => true,
            ]);
        }
    }
}
