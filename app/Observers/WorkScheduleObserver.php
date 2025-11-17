<?php

namespace App\Observers;

use App\Models\WorkSchedule;

class WorkScheduleObserver
{
    public function creating(WorkSchedule $workSchedule): void
    {
        if (empty($workSchedule->kode)) {
            $workSchedule->kode = $this->generateKode();
        }
    }

    private function generateKode(): string
    {
        $lastSchedule = WorkSchedule::withTrashed()
            ->where('kode', 'like', 'JK%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastSchedule) {
            return 'JK001';
        }

        $lastNumber = (int) substr($lastSchedule->kode, 2);
        $newNumber = $lastNumber + 1;

        return 'JK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
