<?php

namespace App\Filament\Resources\Allowances\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Employee;
use App\Models\AllowanceType;
use Filament\Tables\Table;

class AllowancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('employee.nama')
                    ->label('Karyawan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('allowanceType.nama')
                    ->label('Jenis Tunjangan')
                    ->sortable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->numeric()
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),

                TextColumn::make('tanggal_berlaku')
                    ->label('Berlaku')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_berakhir')
                    ->label('Berakhir')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('-'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

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
                SelectFilter::make('employee_id')
                    ->label('Karyawan')
                    ->relationship('employee', 'nama')
                    // atau kalau mau options manual:
                    // ->options(Employee::query()->orderBy('nama')->pluck('nama', 'id'))
                    ->searchable()
                    ->preload(),

                // Filter by jenis tunjangan
                SelectFilter::make('allowance_type_id')
                    ->label('Jenis Tunjangan')
                    ->relationship('allowanceType', 'nama')
                    // ->options(AllowanceType::query()->orderBy('nama')->pluck('nama', 'id'))
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn (\App\Models\Allowance $record) => $record->allowanceType?->is_active), // Edit via modal
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
