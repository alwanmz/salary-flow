<?php

namespace App\Filament\Resources\AllowanceTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AllowanceTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                TextInput::make('kode')
                    ->label('Kode')
                    ->disabled()
                    ->dehydrated(false)     // biar observer yang isi
                    ->visibleOn(['edit']),  // optional: hanya tampil di edit

                TextInput::make('nama')
                    ->label('Nama Tunjangan')
                    ->required()
                    ->maxLength(100),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->visibleOn(['edit'])
                    ->default(true),

                Toggle::make('is_taxable')
                    ->label('Kena Pajak')
                    ->default(false),
            ]);
    }
}
