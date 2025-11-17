<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable(),

                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jenis_kelamin')
                    ->label('Gender')
                    ->badge(),

                TextColumn::make('no_hp')
                    ->label('No HP')
                    ->searchable(),

                TextColumn::make('status_perkawinan')
                    ->label('Perkawinan')
                    ->hidden()
                    ->badge(),

                TextColumn::make('branch.nama')
                    ->label('Cabang')
                    ->sortable(),

                TextColumn::make('department.nama_departemen')
                    ->label('Departemen')
                    ->sortable(),

                TextColumn::make('position.nama_jabatan')
                    ->label('Jabatan')
                    ->sortable(),

                TextColumn::make('workSchedule.nama')
                    ->label('Jadwal Kerja')
                    ->sortable(),

                TextColumn::make('tanggal_masuk')
                    ->label('Tanggal Masuk')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_keluar')
                    ->label('Tanggal Keluar')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status_karyawan')
                    ->label('Status Karyawan')
                    ->badge(),

                TextColumn::make('file_keterangan_kerja')
                    ->label('File Keterangan')
                    ->hidden(),

                ImageColumn::make('foto')
                    ->label('Foto')
                    ->hidden()
                    ->circular(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),

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
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
