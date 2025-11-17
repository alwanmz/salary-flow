<?php

namespace App\Filament\Resources\SalaryAdjustments;

use App\Filament\Resources\SalaryAdjustments\Pages\ManageSalaryAdjustments;
use App\Filament\Resources\SalaryAdjustments\Schemas\SalaryAdjustmentForm;
use App\Filament\Resources\SalaryAdjustments\Tables\SalaryAdjustmentsTable;
use App\Models\SalaryAdjustment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class SalaryAdjustmentResource extends Resource
{
    protected static ?string $model = SalaryAdjustment::class;

    protected static ?string $recordTitleAttribute = 'kode';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Penyesuaian Gaji';

    protected static ?string $pluralModelLabel = 'Penyesuaian Gaji';

    protected static ?int $navigationSort = 24;

    public static function form(Schema $schema): Schema
    {
        return SalaryAdjustmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalaryAdjustmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSalaryAdjustments::route('/'),
        ];
    }
}
