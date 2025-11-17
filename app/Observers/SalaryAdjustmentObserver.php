<?php

namespace App\Observers;

use App\Models\SalaryAdjustment;

class SalaryAdjustmentObserver
{
    /**
     * Handle the SalaryAdjustment "creating" event.
     */
    public function creating(SalaryAdjustment $salaryAdjustment): void
    {
        if (empty($salaryAdjustment->kode)) {
            $salaryAdjustment->kode = $this->generateKode();
        }

        // Auto set created_by
        if (empty($salaryAdjustment->created_by) && auth()->check()) {
            $salaryAdjustment->created_by = auth()->id();
        }
    }

    /**
     * Handle the SalaryAdjustment "updating" event.
     */
    public function updating(SalaryAdjustment $salaryAdjustment): void
    {
        // Auto set approved_by dan approved_at ketika status berubah jadi final
        if ($salaryAdjustment->isDirty('status') && $salaryAdjustment->status === 'final') {
            if (empty($salaryAdjustment->approved_by) && auth()->check()) {
                $salaryAdjustment->approved_by = auth()->id();
                $salaryAdjustment->approved_at = now();
            }
        }
    }

    /**
     * Generate kode otomatis ADJ001, ADJ002, dst
     */
    private function generateKode(): string
    {
        $lastAdjustment = SalaryAdjustment::withTrashed()
            ->where('kode', 'like', 'ADJ%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastAdjustment) {
            return 'ADJ001';
        }

        $lastNumber = (int) substr($lastAdjustment->kode, 3);
        $newNumber = $lastNumber + 1;

        return 'ADJ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
