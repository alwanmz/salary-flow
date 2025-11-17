<?php

namespace App\Filament\Resources\WorkSchedules\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WorkScheduleForm
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

                TextInput::make('nama')
                    ->label('Nama Shift')
                    ->required()
                    ->maxLength(100),

                TimePicker::make('jam_masuk')
                    ->label('Jam Masuk')
                    ->required()
                    ->seconds(false),

                TimePicker::make('jam_pulang')
                    ->label('Jam Pulang')
                    ->required()
                    ->seconds(false),

                
                TextInput::make('total_jam')
                    ->label('Total Jam')
                    ->numeric()
                    ->required()
                    ->default(8),

                Toggle::make('ada_istirahat')
                    ->label('Ada Istirahat')
                    ->default(false)
                    ->reactive(),

                Toggle::make('lintas_hari')
                    ->label('Lintas Hari')
                    ->default(false),

                TimePicker::make('jam_istirahat_mulai')
                    ->label('Istirahat Mulai')
                    ->seconds(false)
                    ->visible(fn ($get) => $get('ada_istirahat')),

                TimePicker::make('jam_istirahat_selesai')
                    ->label('Istirahat Selesai')
                    ->seconds(false)
                    ->visible(fn ($get) => $get('ada_istirahat')),


                Toggle::make('is_active')
                    ->label('Aktif')
                    ->visibleOn(['edit'])
                    ->default(true),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
