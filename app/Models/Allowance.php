<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allowance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode',
        'employee_id',
        'allowance_type_id',
        'nominal',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'is_active',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal_berlaku' => 'date',
        'tanggal_berakhir' => 'date',
        'is_active' => 'boolean',
    ];

    // 👇 AUTO-GENERATE KODE
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($allowance) {
            if (empty($allowance->kode)) {
                $lastAllowance = self::withTrashed()
                    ->where('kode', 'like', 'ALW%')
                    ->orderBy('kode', 'desc')
                    ->first();

                if (!$lastAllowance) {
                    $allowance->kode = 'ALW001';
                } else {
                    $lastNumber = (int) substr($lastAllowance->kode, 3);
                    $newNumber = $lastNumber + 1;
                    $allowance->kode = 'ALW' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                }
            }
        });
    }

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowanceType()
    {
        return $this->belongsTo(AllowanceType::class);
    }
}
