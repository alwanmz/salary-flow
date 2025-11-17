<?php

namespace App\Filament\Resources\Branches\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // 2 kolom utama
            ->schema([
                TextInput::make('kode')
                    ->label('Kode')
                    ->disabled()  
                    ->dehydrated(false)     // biar observer yang isi
                    ->visibleOn(['edit']), // optional: hanya tampil di edit

                TextInput::make('nama_cabang')
                    ->label('Nama Cabang')
                    ->required(),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->columnSpanFull(),

                TextInput::make('telepon')
                    ->label('Telepon')
                    ->tel(),

                TextInput::make('lokasi')
                    ->label('Lokasi'),

                TextInput::make('latitude')
                    ->label('Latitude')
                    ->numeric(),

                TextInput::make('longitude')
                    ->label('Longitude')
                    ->numeric(),

                TextInput::make('radius')
                    ->label('Radius (m)')
                    ->numeric()
                    ->required()
                    ->default(100),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }
}
