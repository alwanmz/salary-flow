<?php

namespace App\Observers;

use App\Models\Position;

class PositionObserver
{
    /**
     * Handle the Position "creating" event.
     */
    public function creating(Position $position): void
    {
        if (empty($position->kode)) {
            $position->kode = $this->generateKode();
        }
    }

    /**
     * Generate kode otomatis JAB001, JAB002, dst
     */
    private function generateKode(): string
    {
        $lastPosition = Position::withTrashed()
            ->where('kode', 'like', 'JAB%')
            ->orderBy('kode', 'desc')
            ->first();

        if (!$lastPosition) {
            return 'JAB001';
        }

        $lastNumber = (int) substr($lastPosition->kode, 3);
        $newNumber = $lastNumber + 1;

        return 'JAB' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
