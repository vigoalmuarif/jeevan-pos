<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'name',
        'gender',
        'birthday',
        'phone',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function businesses(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'user_role_business')
            ->withPivot(['role_id', 'branch_id'])
            ->withTimestamps();
    }

    public function getCurrentBranchIdAttribute()
    {
        return optional(
            $this->businesses()->where('business_id', $this->current_active_business_id)->first()
        )->pivot->branch_id;
    }

    public function assignRoleForBusiness($role, $businessId)
    {
        $this->assignRole($role, $businessId);
    }

    // Mengecek apakah user memiliki role di bisnis tertentu
    public function hasRoleInBusiness($role, $businessId)
    {
        return $this->hasRole($role, $businessId);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class);
    }
}
