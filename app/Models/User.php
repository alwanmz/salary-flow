<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants; 
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasTenants
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar_url',
        'phone',
        'password',
        'branch_id',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active;
    }

    // 👇 MULTI-TENANCY: Define Tenants (Cabang)
    public function getTenants(Panel $panel): Collection
    {
        // Super Admin bisa akses semua cabang
        if ($this->hasRole('super_admin')) {
            return \App\Models\Branch::all();
        }
        
        // User lain hanya akses cabang sendiri
        return \App\Models\Branch::where('id', $this->branch_id)->get();
    }

    // 👇 MULTI-TENANCY: Tenant yang sedang aktif
    public function getTenant(Panel $panel): ?Model
    {
        return $this->branch;
    }

    // 👇 MULTI-TENANCY: Cek akses ke tenant
    public function canAccessTenant(Model $tenant): bool
    {
        // Super Admin bisa akses semua
        if ($this->hasRole('super_admin')) {
            return true;
        }
        
        // User hanya bisa akses cabang sendiri
        return $this->branch_id === $tenant->id;
    }

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function scopeByBranch($query, $branchId)
    {
        if ($branchId) {
            return $query->where('branch_id', $branchId);
        }
        return $query;
    }
}
