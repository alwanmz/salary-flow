<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode',
        'nama',
        'jam_masuk',
        'jam_pulang',
        'ada_istirahat',
        'jam_istirahat_mulai',
        'jam_istirahat_selesai',
        'total_jam',
        'lintas_hari',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'jam_masuk' => 'datetime:H:i',
        'jam_pulang' => 'datetime:H:i',
        'jam_istirahat_mulai' => 'datetime:H:i',
        'jam_istirahat_selesai' => 'datetime:H:i',
        'ada_istirahat' => 'boolean',
        'lintas_hari' => 'boolean',
        'total_jam' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
