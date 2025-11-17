<?php

namespace App\Filament\Resources\Allowances\Pages;

use App\Filament\Resources\Allowances\AllowanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAllowances extends ManageRecords
{
    protected static string $resource = AllowanceResource::class;

    protected static ?string $title = 'Tunjangan';

    protected function getActions(): array
    {
        return [
            CreateAction::make(), 
        ];
    }
}
