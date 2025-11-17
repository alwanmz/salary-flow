<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'no_hp',
        'status_perkawinan',
        'branch_id',
        'department_id',
        'position_id',
        'work_schedule_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'status_karyawan',
        'file_keterangan_kerja',
        'foto',
        'email',
        'user_id',
        'is_active',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baseSalaries()
    {
        return $this->hasMany(BaseSalary::class);
    }

    public function currentBaseSalary()
    {
        return $this->hasOne(BaseSalary::class)
            ->where('is_active', true)
            ->whereDate('tanggal_berlaku', '<=', now())
            ->where(function($query) {
                $query->whereNull('tanggal_berakhir')
                      ->orWhereDate('tanggal_berakhir', '>=', now());
            })
            ->latest('tanggal_berlaku');
    }

    public function allowances()
    {
        return $this->hasMany(Allowance::class);
    }

    public function activeAllowances()
    {
        return $this->hasMany(Allowance::class)
            ->where('is_active', true)
            ->whereDate('tanggal_berlaku', '<=', now())
            ->where(function($query) {
                $query->whereNull('tanggal_berakhir')
                      ->orWhereDate('tanggal_berakhir', '>=', now());
            });
    }

    public function bpjsHealth()
    {
        return $this->hasOne(BpjsHealth::class)
            ->where('is_active', true)
            ->latest('tanggal_berlaku');
    }

    public function bpjsEmployment()
    {
        return $this->hasOne(BpjsEmployment::class)
            ->where('is_active', true)
            ->latest('tanggal_berlaku');
    }

    public function salaryAdjustmentDetails()
    {
        return $this->hasMany(SalaryAdjustmentDetail::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
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

    public function scopeByBranch($query, $branchId)
    {
        if ($branchId) {
            return $query->where('branch_id', $branchId);
        }
        return $query;
    }

    public function scopeByDepartment($query, $departmentId)
    {
        if ($departmentId) {
            return $query->where('department_id', $departmentId);
        }
        return $query;
    }

    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status_karyawan', $status);
        }
        return $query;
    }
}
