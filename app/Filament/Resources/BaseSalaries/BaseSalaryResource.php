<?php

namespace App\Filament\Resources\BaseSalaries;

use App\Filament\Resources\BaseSalaries\Pages\ManageBaseSalaries;
use App\Filament\Resources\BaseSalaries\Schemas\BaseSalaryForm;
use App\Filament\Resources\BaseSalaries\Tables\BaseSalariesTable;
use App\Models\BaseSalary;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class BaseSalaryResource extends Resource
{
    protected static ?string $model = BaseSalary::class;

    protected static ?string $recordTitleAttribute = 'employee_id';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Gaji Pokok';

    protected static ?string $pluralModelLabel = 'Gaji Pokok';

    protected static ?int $navigationSort = 23;

    public static function form(Schema $schema): Schema
    {
        return BaseSalaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BaseSalariesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBaseSalaries::route('/'),
        ];
    }
}
