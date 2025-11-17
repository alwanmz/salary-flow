<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BpjsHealth extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bpjs_health';

    protected $fillable = [
        'employee_id',
        'nomor_bpjs',
        'kelas',
        'upah_untuk_bpjs',
        'iuran_perusahaan',
        'iuran_karyawan',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'is_active',
    ];

    protected $casts = [
        'upah_untuk_bpjs' => 'decimal:2',
        'iuran_perusahaan' => 'decimal:2',
        'iuran_karyawan' => 'decimal:2',
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
}
