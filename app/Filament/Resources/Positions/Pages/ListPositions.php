<?php

namespace App\Filament\Resources\Positions\Pages;

use App\Filament\Resources\Positions\PositionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePositions extends ManageRecords
{
    protected static string $resource = PositionResource::class;

    protected static ?string $title = 'Jabatan';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
