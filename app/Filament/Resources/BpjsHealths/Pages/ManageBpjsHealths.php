<?php

namespace App\Filament\Resources\BpjsHealths\Pages;

use App\Filament\Resources\BpjsHealths\BpjsHealthResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBpjsHealths extends ManageRecords
{
    protected static string $resource = BpjsHealthResource::class;

    protected static ?string $title = 'BPJS Kesehatan';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
