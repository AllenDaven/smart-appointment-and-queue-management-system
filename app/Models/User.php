<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship: User has many appointments
    public function appointments(): HasMany
    {
        return $this->hasMany(\App\Models\Appointment::class);
    }

    // Relationship: User belongs to a role
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }
}