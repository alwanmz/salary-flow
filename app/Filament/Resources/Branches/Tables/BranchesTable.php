<?php

namespace App\Filament\Resources\Branches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BranchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('nama_cabang')
                    ->label('Nama Cabang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable(),

                TextColumn::make('latitude')
                    ->label('Lat')
                    ->numeric()
                    ->sortable()
                    ->hidden(),

                TextColumn::make('longitude')
                    ->label('Long')
                    ->numeric()
                    ->sortable()
                    ->hidden(),

                TextColumn::make('radius')
                    ->label('Radius (m)')
                    ->numeric()
                    ->hidden(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->hidden(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->hidden(),

                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->hidden(),

                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->hidden(),
            ])
            ->filters([
            ])
            ->recordActions([
                EditAction::make(),     // edit via modal
                DeleteAction::make(),   // delete per row
            ])
            ->bulkActions([
            ]);
    }
}
