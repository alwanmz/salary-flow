<?php

namespace App\Filament\Resources\BpjsHealths;

use App\Filament\Resources\BpjsHealths\Pages\ManageBpjsHealths;
use App\Filament\Resources\BpjsHealths\Schemas\BpjsHealthForm;
use App\Filament\Resources\BpjsHealths\Tables\BpjsHealthsTable;
use App\Models\BpjsHealth;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class BpjsHealthResource extends Resource
{
    protected static ?string $model = BpjsHealth::class;

    protected static ?string $recordTitleAttribute = 'nomor_bpjs';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'BPJS Kesehatan';

    protected static ?string $pluralModelLabel = 'BPJS Kesehatan';

    protected static ?int $navigationSort = 25;

    public static function form(Schema $schema): Schema
    {
        return BpjsHealthForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BpjsHealthsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBpjsHealths::route('/'),
        ];
    }
}
