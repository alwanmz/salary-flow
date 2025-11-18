<?php

namespace App\Filament\Resources\LeaveRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class LeaveRequestsTable
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

                TextColumn::make('employee.nama')
                    ->label('Karyawan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('leaveType.jenis_cuti')
                    ->label('Jenis Cuti')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_absen')
                    ->label('Jenis Absen')
                    ->badge(),

                TextColumn::make('tanggal_dari')
                    ->label('Tanggal Dari')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_ke')
                    ->label('Tanggal Ke')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jumlah_hari')
                    ->label('Jumlah Hari')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('file_surat_sakit')
                    ->label('File Sakit')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('approver.name')
                    ->label('Disetujui Oleh')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Tanggal Disetujui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
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
                // kosong sesuai perintah uhuy
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
