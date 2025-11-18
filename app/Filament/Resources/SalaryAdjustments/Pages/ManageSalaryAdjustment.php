<?php

namespace App\Filament\Resources\SalaryAdjustments\Pages;

use App\Filament\Resources\SalaryAdjustments\SalaryAdjustmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSalaryAdjustments extends ManageRecords
{
    protected static string $resource = SalaryAdjustmentResource::class;

    protected static ?string $title = 'Penyesuaian Gaji';

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('New Data'),
        ];
    }
}
