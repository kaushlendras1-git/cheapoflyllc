<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'pseudo',
        'lob',
        'address',
        'password',
        'phone',
        'role',
        'departments',
        'status',
        'remember_token',
        'profile_picture',
        'pan_card',
        'aadhar_card'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function teamAssignments()
    {
        return $this->hasMany(UserTeamAssignment::class);
    }

    public function currentTeam()
    {
        return $this->hasOne(UserTeamAssignment::class)
            ->whereDate('effective_from', '<=', now())
            ->where(function ($q) {
                $q->whereNull('effective_to')->orWhere('effective_to', '>=', now());
            });
    }

    public function shiftAssignments()
    {
        return $this->hasMany(UserShiftAssignment::class);
    }

    public function currentShift()
    {
        return $this->hasOne(UserShiftAssignment::class)
            ->whereDate('effective_from', '<=', now())
            ->where(function ($q) {
                $q->whereNull('effective_to')->orWhere('effective_to', '>=', now());
            });
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
