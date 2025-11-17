<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageEmployees extends ManageRecords
{
    protected static string $resource = EmployeeResource::class;

    protected static ?string $title = 'Karyawan';

    protected function getActions(): array
    {
        return [
            CreateAction::make()
                ->after(function ($record, $data, $action) {
                    // Redirect ke list/eindex setelah create
                    return redirect(EmployeeResource::getUrl('index'));
                }),
        ];
    }
}
