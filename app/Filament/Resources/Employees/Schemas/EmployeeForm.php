<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                    ->required(),

                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir'),

                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->columnSpanFull(),

                Select::make('jenis_kelamin')
                    ->label('Gender')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                    ->required(),

                TextInput::make('no_hp')
                    ->label('No HP'),

                Select::make('status_perkawinan')
                    ->label('Status Perkawinan')
                    ->options([
                        'TK/0' => 'TK/0',
                        'TK/1' => 'TK/1',
                        'TK/2' => 'TK/2',
                        'TK/3' => 'TK/3',
                        'K/0' => 'K/0',
                        'K/1' => 'K/1',
                        'K/2' => 'K/2',
                        'K/3' => 'K/3',
                    ])
                    ->default('TK/0')
                    ->required(),

                Select::make('branch_id')
                    ->label('Cabang')
                    ->relationship(
                        'branch', 'nama',
                        fn($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('department_id')
                    ->label('Departemen')
                    ->relationship(
                        'department', 'nama_departemen',
                        fn($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('position_id')
                    ->label('Jabatan')
                    ->relationship(
                        'position', 'nama_jabatan',
                        fn($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('work_schedule_id')
                    ->label('Jadwal Kerja')
                    ->relationship(
                        'workSchedule', 'nama',
                        fn($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload(),

                DatePicker::make('tanggal_masuk')
                    ->label('Tanggal Masuk')
                    ->required(),

                DatePicker::make('tanggal_keluar')
                    ->label('Tanggal Keluar'),

                Select::make('status_karyawan')
                    ->label('Status Karyawan')
                    ->options([
                        'tetap' => 'Tetap',
                        'kontrak' => 'Kontrak',
                        'probation' => 'Probation',
                        'magang' => 'Magang',
                        'resign' => 'Resign',
                    ])
                    ->default('probation')
                    ->required(),

                FileUpload::make('file_keterangan_kerja')
                    ->label('File Keterangan Kerja')
                    ->directory('keterangan_kerja')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->nullable(),

                FileUpload::make('foto')
                    ->label('Foto')
                    ->directory('foto_karyawan')
                    ->image()
                    ->maxSize(2048)
                    ->nullable(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email(),

                Select::make('user_id')
                    ->label('User Login')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
