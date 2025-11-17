<?php

namespace App\Observers;

use App\Models\LeaveType;

class LeaveTypeObserver
{
    /**
     * Handle the LeaveType "creating" event.
     */
    public function creating(LeaveType $leaveType): void
    {
        if (empty($leaveType->kode_cuti)) {
            $leaveType->kode_cuti = $this->generateKode();
        }
    }

    /**
     * Generate kode otomatis CT001, CT002, dst
     */
    private function generateKode(): string
    {
        $lastLeaveType = LeaveType::withTrashed()
            ->where('kode_cuti', 'like', 'CT%')
            ->orderBy('kode_cuti', 'desc')
            ->first();

        if (!$lastLeaveType) {
            return 'CT001';
        }

        $lastNumber = (int) substr($lastLeaveType->kode_cuti, 2);
        $newNumber = $lastNumber + 1;

        return 'CT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
