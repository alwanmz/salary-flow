<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver
{
    /**
     * Handle the Department "creating" event.
     */
    public function creating(Department $department): void
    {
        if (empty($department->kode)) {
            $department->kode = $this->generateKode();
        }
    }

    /**
     * Generate kode otomatis DEP001, DEP002, dst
     */
    private function generateKode(): string
    {
        $lastDepartment = Department::withTrashed()
            ->where('kode', 'like', 'DEP%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastDepartment) {
            return 'DEP001';
        }

        $lastNumber = (int) substr($lastDepartment->kode, 3);
        $newNumber = $lastNumber + 1;

        return 'DEP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
