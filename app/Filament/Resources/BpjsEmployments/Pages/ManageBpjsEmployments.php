<?php

namespace App\Filament\Resources\BpjsEmployments\Pages;

use App\Filament\Resources\BpjsEmployments\BpjsEmploymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBpjsEmployments extends ManageRecords
{
    protected static string $resource = BpjsEmploymentResource::class;

    protected static ?string $title = 'BPJS Ketenagakerjaan';

    protected function getActions(): array
    {
        return [
            CreateAction::make()->label('New Data'),
        ];
    }
}
