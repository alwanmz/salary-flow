<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseSalary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'nominal',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal_berlaku' => 'date',
        'tanggal_berakhir' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_active', true)
            ->whereDate('tanggal_berlaku', '<=', now())
            ->where(function($query) {
                $query->whereNull('tanggal_berakhir')
                      ->orWhereDate('tanggal_berakhir', '>=', now());
            });
    }
}
