<?php

namespace App\Filament\Resources\LeaveTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LeaveTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                TextInput::make('kode_cuti')
                    ->label('Kode')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                TextInput::make('jenis_cuti')
                    ->label('Jenis Cuti')
                    ->required()
                    ->maxLength(100),

                TextInput::make('jumlah_hari')
                    ->label('Jumlah Hari')
                    ->numeric()
                    ->required()
                    ->default(0),

                Toggle::make('is_paid')
                    ->label('Cuti Dibayar')
                    ->default(true),

                Toggle::make('requires_approval')
                    ->label('Perlu Persetujuan')
                    ->default(true),

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
