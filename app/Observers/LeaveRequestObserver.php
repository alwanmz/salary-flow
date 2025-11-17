<?php

namespace App\Observers;

use App\Models\LeaveRequest;

class LeaveRequestObserver
{
    /**
     * Handle the LeaveRequest "creating" event.
     */
    public function creating(LeaveRequest $leaveRequest): void
    {
        if (empty($leaveRequest->kode)) {
            $leaveRequest->kode = $this->generateKode();
        }

        // Auto calculate jumlah_hari
        if (empty($leaveRequest->jumlah_hari)) {
            $leaveRequest->jumlah_hari = $leaveRequest->calculateWorkingDays();
        }
    }

    /**
     * Handle the LeaveRequest "updating" event.
     */
    public function updating(LeaveRequest $leaveRequest): void
    {
        // Re-calculate jumlah_hari jika tanggal berubah
        if ($leaveRequest->isDirty(['tanggal_dari', 'tanggal_ke'])) {
            $leaveRequest->jumlah_hari = $leaveRequest->calculateWorkingDays();
        }

        // Auto set approved_by dan approved_at ketika status approved
        if ($leaveRequest->isDirty('status') && $leaveRequest->status === 'approved') {
            if (empty($leaveRequest->approved_by) && auth()->check()) {
                $leaveRequest->approved_by = auth()->id();
                $leaveRequest->approved_at = now();
            }
        }
    }

    /**
     * Generate kode otomatis LRQ001, LRQ002, dst
     */
    private function generateKode(): string
    {
        $lastLeaveRequest = LeaveRequest::withTrashed()
            ->where('kode', 'like', 'LRQ%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastLeaveRequest) {
            return 'LRQ001';
        }

        $lastNumber = (int) substr($lastLeaveRequest->kode, 3);
        $newNumber = $lastNumber + 1;

        return 'LRQ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
