<?php

namespace App\Observers;

use App\Models\Allowance;

class AllowanceObserver
{
    /**
     * Handle the Allowance "creating" event.
     */
    public function creating(Allowance $allowance): void
    {
        if (empty($allowance->kode)) {
            $allowance->kode = $this->generateKode();
        }
    }

    /**
     * Generate kode otomatis ALW001, ALW002, dst
     */
    private function generateKode(): string
    {
        $lastAllowance = Allowance::withTrashed()
            ->where('kode', 'like', 'ALW%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastAllowance) {
            return 'ALW001';
        }

        $lastNumber = (int) substr($lastAllowance->kode, 3);
        $newNumber = $lastNumber + 1;

        return 'ALW' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
