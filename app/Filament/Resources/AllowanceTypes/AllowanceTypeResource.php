<?php

namespace App\Filament\Resources\AllowanceTypes;

use App\Filament\Resources\AllowanceTypes\Pages\ManageAllowanceTypes;
use App\Filament\Resources\AllowanceTypes\Schemas\AllowanceTypeForm;
use App\Filament\Resources\AllowanceTypes\Tables\AllowanceTypesTable;
use App\Models\AllowanceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class AllowanceTypeResource extends Resource
{
    protected static ?string $model = AllowanceType::class;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static string | UnitEnum | null $navigationGroup = 'Payroll';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Master Tunjangan';

    protected static ?string $pluralModelLabel = 'Master Tunjangan';

    protected static ?int $navigationSort = 21;

    public static function form(Schema $schema): Schema
    {
        return AllowanceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AllowanceTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAllowanceTypes::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
