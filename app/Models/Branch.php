<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode',
        'nama_cabang',
        'alamat',
        'telepon',
        'lokasi',
        'latitude',
        'longitude',
        'radius',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    // 👇 Boot method untuk auto-generate kode
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($branch) {
            if (empty($branch->kode)) {
                $lastBranch = self::withTrashed()
                    ->where('kode', 'like', 'BR%')
                    ->orderBy('kode', 'desc')
                    ->first();

                if (!$lastBranch) {
                    $branch->kode = 'BR001';
                } else {
                    $lastNumber = (int) substr($lastBranch->kode, 2);
                    $newNumber = $lastNumber + 1;
                    $branch->kode = 'BR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
                }
            }
        });
    }

    // Relationships
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // 👇 Untuk display di tenant switcher
    public function getNameAttribute()
    {
        return $this->nama_cabang;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
