<?php

namespace App\Filament\Resources\Allowances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AllowanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                TextInput::make('kode')
                    ->label('Kode')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                Select::make('employee_id')
                    ->label('Karyawan')
                    ->relationship('employee', 'nama') 
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('allowance_type_id')
                    ->label('Jenis Tunjangan')
                    ->relationship(
                        name: 'allowanceType',
                        titleAttribute: 'nama',
                        modifyQueryUsing: fn ($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('tanggal_berlaku')
                    ->label('Tanggal Berlaku')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                DatePicker::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->after('tanggal_berlaku')
                    ->nullable(),
                
                TextInput::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->visibleOn(['edit'])
                    ->default(true),
                // is_active bisa jadi toggle di form,
                // atau otomatis aktif saat create
            ]);
    }
}
