<?php

namespace App\Filament\Resources\Allowances;

use App\Filament\Resources\Allowances\Pages\ManageAllowances;
use App\Filament\Resources\Allowances\Schemas\AllowanceForm;
use App\Filament\Resources\Allowances\Tables\AllowancesTable;
use App\Models\Allowance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class AllowanceResource extends Resource
{
    protected static ?string $model = Allowance::class;

    protected static ?string $slug = 'tunjangan';

    protected static ?string $recordTitleAttribute = 'kode';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static ?string $navigationLabel = 'Tunjangan'; 

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 22;

    public static function form(Schema $schema): Schema
    {
        return AllowanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AllowancesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAllowances::route('/'),
        ];
    }
}
