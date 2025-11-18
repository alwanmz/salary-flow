<?php

namespace App\Filament\Resources\WorkSchedules\Pages;

use App\Filament\Resources\WorkSchedules\WorkScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkSchedules extends ManageRecords
{
    protected static string $resource = WorkScheduleResource::class;

    protected static ?string $title = 'Jam Kerja';

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('New Data'),
        ];
    }
}
