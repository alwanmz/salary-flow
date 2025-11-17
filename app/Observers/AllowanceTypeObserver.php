<?php

namespace App\Observers;

use App\Models\AllowanceType;

class AllowanceTypeObserver
{
    public function creating(AllowanceType $allowanceType): void
    {
        if (empty($allowanceType->kode)) {
            $allowanceType->kode = $this->generateKode();
        }
    }

    private function generateKode(): string
    {
        $lastAllowanceType = AllowanceType::withTrashed()
            ->where('kode', 'like', 'TJ%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastAllowanceType) {
            return 'TJ001';
        }

        $lastNumber = (int) substr($lastAllowanceType->kode, 2);
        $newNumber = $lastNumber + 1;

        return 'TJ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
