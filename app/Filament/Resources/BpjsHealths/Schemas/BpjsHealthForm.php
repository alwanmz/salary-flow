<?php

namespace App\Filament\Resources\BpjsHealths\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BpjsHealthForm
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

                TextInput::make('nomor_bpjs')
                    ->label('Nomor BPJS')
                    ->maxLength(100),

                Select::make('kelas')
                    ->label('Kelas')
                    ->options([
                        1 => 'Kelas 1',
                        2 => 'Kelas 2',
                        3 => 'Kelas 3',
                    ])
                    ->default(3)
                    ->required(),

                TextInput::make('upah_untuk_bpjs')
                    ->label('Upah untuk BPJS')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('iuran_perusahaan')
                    ->label('Iuran Perusahaan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('iuran_karyawan')
                    ->label('Iuran Karyawan')
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
            ]);
    }
}
