<?php

namespace App\Filament\Resources\BaseSalaries\Pages;

use App\Filament\Resources\BaseSalaries\BaseSalaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBaseSalaries extends ManageRecords
{
    protected static string $resource = BaseSalaryResource::class;

    protected static ?string $title = 'Gaji Pokok';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
