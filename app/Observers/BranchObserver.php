<?php

namespace App\Observers;

use App\Models\Branch;

class BranchObserver
{
    public function creating(Branch $branch): void
    {
        if (empty($branch->kode)) {
            $branch->kode = $this->generateKode();
        }
    }

    private function generateKode(): string
    {
        $lastBranch = Branch::withTrashed()
            ->where('kode', 'like', 'BR%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastBranch) {
            return 'BR001';
        }

        $lastNumber = (int) substr($lastBranch->kode, 2);
        $newNumber = $lastNumber + 1;

        return 'BR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
