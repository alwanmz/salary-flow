<?php

namespace App\Filament\Resources\BaseSalaries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BaseSalaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                Select::make('employee_id')
                    ->label('Karyawan')
                    ->relationship('employee', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

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

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->visibleOn(['edit']),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
