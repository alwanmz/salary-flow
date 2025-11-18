<?php

namespace App\Filament\Resources\Departments\Pages;

use App\Filament\Resources\Departments\DepartmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDepartments extends ManageRecords
{
    protected static string $resource = DepartmentResource::class;

    protected static ?string $title = 'Departemen';

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('New Data'),
        ];
    }
}
