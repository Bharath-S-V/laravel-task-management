<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // Ensure this is fillable if you're using it in forms or seeding
        'designation', // Add designation to the fillable array
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->is_admin; // Assuming you have an 'is_admin' column in the users table
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
}
