<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdjustmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_adjustment_id',
        'employee_id',
        'nominal_penambahan',
        'nominal_pengurangan',
        'keterangan',
    ];

    protected $casts = [
        'nominal_penambahan' => 'decimal:2',
        'nominal_pengurangan' => 'decimal:2',
    ];

    // Relationships
    public function salaryAdjustment()
    {
        return $this->belongsTo(SalaryAdjustment::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
