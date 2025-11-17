<?php

namespace App\Filament\Resources\SalaryAdjustments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SalaryAdjustmentForm
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

                Select::make('bulan')
                    ->label('Bulan')
                    ->options([
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                        4 => 'April', 5 => 'Mei', 6 => 'Juni',
                        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                        10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                    ])
                    ->required(),

                TextInput::make('tahun')
                    ->label('Tahun')
                    ->numeric()
                    ->required()
                    ->default(date('Y')),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'final' => 'Final',
                    ])
                    ->default('draft')
                    ->required(),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->columnSpanFull(),

                // Field approval (hanya tampil di edit, disabled)
                TextInput::make('created_by')
                    ->label('Dibuat Oleh')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                TextInput::make('approved_by')
                    ->label('Disetujui Oleh')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                DateTimePicker::make('approved_at')
                    ->label('Tgl Disetujui')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn(['edit']),

                // Detail (repeater untuk banyak employee)
                Repeater::make('details')
                    ->label('Detail Karyawan')
                    ->relationship('details')
                    ->schema([
                        Select::make('employee_id')
                            ->label('Karyawan')
                            ->relationship('employee', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->rules([
                                fn ($get) => function ($attribute, $value, $fail) use ($get) {
                                    // Ambil bulan & tahun dari parent (SalaryAdjustment)
                                    $bulan = $get('../../bulan');
                                    $tahun = $get('../../tahun');
                                    
                                    // Cek apakah employee ini sudah ada di periode yang sama (di SalaryAdjustment lain)
                                    $exists = \App\Models\SalaryAdjustmentDetail::whereHas('salaryAdjustment', function ($q) use ($bulan, $tahun) {
                                        $q->where('bulan', $bulan)
                                          ->where('tahun', $tahun);
                                    })
                                    ->where('employee_id', $value)
                                    ->exists();

                                    if ($exists) {
                                        $fail('Karyawan ini sudah ada penyesuaian di periode yang dipilih.');
                                    }
                                },
                            ]),

                        TextInput::make('nominal_penambahan')
                            ->label('Penambahan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        TextInput::make('nominal_pengurangan')
                            ->label('Pengurangan')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),

                        Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->defaultItems(0)
                    ->addActionLabel('Tambah Karyawan')
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
