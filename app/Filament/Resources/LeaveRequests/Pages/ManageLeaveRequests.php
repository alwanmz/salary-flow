<?php

namespace App\Filament\Resources\LeaveRequests\Pages;

use App\Filament\Resources\LeaveRequests\LeaveRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLeaveRequests extends ManageRecords
{
    protected static string $resource = LeaveRequestResource::class;

    protected static ?string $title = 'Pengajuan Izin/Cuti';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
