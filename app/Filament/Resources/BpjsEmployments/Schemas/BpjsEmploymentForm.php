<?php

namespace App\Filament\Resources\BpjsEmployments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BpjsEmploymentForm
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

                TextInput::make('upah_untuk_bpjs')
                    ->label('Upah untuk BPJS')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jht_perusahaan')
                    ->label('JHT Perusahaan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jht_karyawan')
                    ->label('JHT Karyawan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jp_perusahaan')
                    ->label('JP Perusahaan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jp_karyawan')
                    ->label('JP Karyawan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jkk_perusahaan')
                    ->label('JKK Perusahaan')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),

                TextInput::make('jkm_perusahaan')
                    ->label('JKM Perusahaan')
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
