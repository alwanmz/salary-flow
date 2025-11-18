<?php

namespace App\Filament\Resources\AllowanceTypes\Pages;

use App\Filament\Resources\AllowanceTypes\AllowanceTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAllowanceTypes extends ManageRecords
{
    protected static string $resource = AllowanceTypeResource::class;

    protected static ?string $title = 'Jenis Tunjangan';

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('New Data'),
        ];
    }
}
