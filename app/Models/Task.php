<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // The table associated with the model (optional if table name follows Laravel conventions)
    protected $table = 'tasks';

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'details',
        'date',
        'priority',
        'assigned_to',
        'progress',
    ];

    // Task belongs to a user (assigned_to relationship)
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
