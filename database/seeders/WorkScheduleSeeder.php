<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkSchedule;

class WorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'nama' => 'Regular Office Hours',
                'jam_masuk' => '08:00:00',
                'jam_pulang' => '17:00:00',
                'ada_istirahat' => true,
                'jam_istirahat_mulai' => '12:00:00',
                'jam_istirahat_selesai' => '13:00:00',
                'total_jam' => 8.0,
                'lintas_hari' => false,
                'keterangan' => 'Jam kerja regular senin-jumat',
            ],
            [
                'nama' => 'Shift Pagi',
                'jam_masuk' => '06:00:00',
                'jam_pulang' => '14:00:00',
                'ada_istirahat' => true,
                'jam_istirahat_mulai' => '10:00:00',
                'jam_istirahat_selesai' => '11:00:00',
                'total_jam' => 7.0,
                'lintas_hari' => false,
                'keterangan' => 'Shift pagi untuk operasional',
            ],
            [
                'nama' => 'Shift Siang',
                'jam_masuk' => '14:00:00',
                'jam_pulang' => '22:00:00',
                'ada_istirahat' => true,
                'jam_istirahat_mulai' => '18:00:00',
                'jam_istirahat_selesai' => '19:00:00',
                'total_jam' => 7.0,
                'lintas_hari' => false,
                'keterangan' => 'Shift siang untuk operasional',
            ],
            [
                'nama' => 'Shift Malam',
                'jam_masuk' => '22:00:00',
                'jam_pulang' => '06:00:00',
                'ada_istirahat' => true,
                'jam_istirahat_mulai' => '02:00:00',
                'jam_istirahat_selesai' => '03:00:00',
                'total_jam' => 7.0,
                'lintas_hari' => true,
                'keterangan' => 'Shift malam lintas hari',
            ],
            [
                'nama' => 'Flexible Hours',
                'jam_masuk' => '09:00:00',
                'jam_pulang' => '18:00:00',
                'ada_istirahat' => true,
                'jam_istirahat_mulai' => '12:00:00',
                'jam_istirahat_selesai' => '13:00:00',
                'total_jam' => 8.0,
                'lintas_hari' => false,
                'keterangan' => 'Jam kerja fleksibel untuk staff tertentu',
            ],
        ];

        foreach ($schedules as $schedule) {
            WorkSchedule::create([
                'nama' => $schedule['nama'],
                'jam_masuk' => $schedule['jam_masuk'],
                'jam_pulang' => $schedule['jam_pulang'],
                'ada_istirahat' => $schedule['ada_istirahat'],
                'jam_istirahat_mulai' => $schedule['jam_istirahat_mulai'],
                'jam_istirahat_selesai' => $schedule['jam_istirahat_selesai'],
                'total_jam' => $schedule['total_jam'],
                'lintas_hari' => $schedule['lintas_hari'],
                'keterangan' => $schedule['keterangan'],
                'is_active' => true,
            ]);
        }
    }
}
