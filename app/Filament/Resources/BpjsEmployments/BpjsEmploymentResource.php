<?php

namespace App\Filament\Resources\BpjsEmployments;

use App\Filament\Resources\BpjsEmployments\Pages\ManageBpjsEmployments;
use App\Filament\Resources\BpjsEmployments\Schemas\BpjsEmploymentForm;
use App\Filament\Resources\BpjsEmployments\Tables\BpjsEmploymentsTable;
use App\Models\BpjsEmployment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class BpjsEmploymentResource extends Resource
{
    protected static ?string $model = BpjsEmployment::class;

    protected static ?string $recordTitleAttribute = 'nomor_bpjs';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'BPJS Ketenagakerjaan';

    protected static ?string $pluralModelLabel = 'BPJS Ketenagakerjaan';

    protected static ?int $navigationSort = 26;

    public static function form(Schema $schema): Schema
    {
        return BpjsEmploymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BpjsEmploymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBpjsEmployments::route('/'),
        ];
    }
}
