<?php

namespace App\Filament\Resources\Branches\Pages;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageBranches extends ManageRecords
{
    protected static string $resource = BranchResource::class;

    protected static ?string $title = 'Cabang';

    protected function getActions(): array
    {
        return [
            CreateAction::make(), // create via modal
        ];
    }
}
