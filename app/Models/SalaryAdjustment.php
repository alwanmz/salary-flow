<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryAdjustment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode',
        'bulan',
        'tahun',
        'status',
        'keterangan',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function details()
    {
        return $this->hasMany(SalaryAdjustmentDetail::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scopes
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFinal($query)
    {
        return $query->where('status', 'final');
    }

    public function scopeForPeriod($query, $bulan, $tahun)
    {
        return $query->where('bulan', $bulan)
                    ->where('tahun', $tahun);
    }
}
