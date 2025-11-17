<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LeaveRequestForm
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

                Select::make('employee_id')
                    ->label('Karyawan')
                    ->relationship('employee', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('leave_type_id')
                    ->label('Jenis Cuti')
                    ->relationship('leaveType', 'jenis_cuti', fn ($query) => $query->where('is_active', true))
                    ->searchable()
                    ->preload(),

                Select::make('jenis_absen')
                    ->label('Jenis Absen')
                    ->options([
                        'izin' => 'Izin',
                        'cuti' => 'Cuti',
                        'sakit' => 'Sakit',
                    ])
                    ->required()
                    ->reactive(),

                DatePicker::make('tanggal_dari')
                    ->label('Tanggal Dari')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                DatePicker::make('tanggal_ke')
                    ->label('Tanggal Ke')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                TextInput::make('jumlah_hari')
                    ->label('Jumlah Hari')
                    ->required()
                    ->numeric(),

                FileUpload::make('file_surat_sakit')
                    ->label('File Surat Sakit')
                    ->directory('surat_sakit')
                    ->visibility('private')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->visible(fn ($get) => $get('jenis_absen') === 'sakit')
                    ->required(fn ($get) => $get('jenis_absen') === 'sakit'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required()
                    ->visible(fn($get, $record) => $record !== null),

                Select::make('approved_by')
                    ->label('Disetujui Oleh')
                    ->relationship('approver', 'name') // relasi ke User (pastikan relasi sudah benar di model LeaveRequest)
                    ->searchable()
                    ->preload()
                    ->visibleOn(['edit']), // hanya tampil saat edit

                DateTimePicker::make('approved_at')
                    ->label('Tanggal Disetujui')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                Textarea::make('rejection_reason')
                    ->label('Keterangan')
                    ->columnSpanFull(),
            ]);
    }
}
