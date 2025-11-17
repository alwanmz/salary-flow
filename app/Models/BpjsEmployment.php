<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BpjsEmployment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bpjs_employment';

    protected $fillable = [
        'employee_id',
        'nomor_bpjs',
        'upah_untuk_bpjs',
        'jht_perusahaan',
        'jht_karyawan',
        'jp_perusahaan',
        'jp_karyawan',
        'jkk_perusahaan',
        'jkm_perusahaan',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'is_active',
    ];

    protected $casts = [
        'upah_untuk_bpjs' => 'decimal:2',
        'jht_perusahaan' => 'decimal:2',
        'jht_karyawan' => 'decimal:2',
        'jp_perusahaan' => 'decimal:2',
        'jp_karyawan' => 'decimal:2',
        'jkk_perusahaan' => 'decimal:2',
        'jkm_perusahaan' => 'decimal:2',
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
