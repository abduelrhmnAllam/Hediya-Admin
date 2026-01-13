<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Admin extends Authenticatable implements FilamentUser
{
    use Notifiable, HasRoles, LogsActivity;

    protected static $logName = 'admin';

    protected $table = 'admins';

    protected string $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected function getDefaultGuardName(): string
    {
        return 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->roles()->exists();
    }

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar
            ? url('uploads/avatars/' . $this->avatar)
            : null;
    }

    // ⭐ ده المهم
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
