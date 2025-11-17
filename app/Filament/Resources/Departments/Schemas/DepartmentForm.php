<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DepartmentForm
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

                TextInput::make('nama_departemen')
                    ->label('Nama Departemen')
                    ->required()
                    ->maxLength(100),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->visibleOn(['edit'])
                    ->default(true),
            ]);
    }
}
