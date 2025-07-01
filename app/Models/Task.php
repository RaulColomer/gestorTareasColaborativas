<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'status'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'task_user_shared');
    }

    public function getStatusLabelAttribute()
    {
        return $this->status === 'pending' ? 'pendiente' : 'completada';
    }

    public function getDueDateFormattedAttribute()
    {
        return $this->due_date
            ? \Carbon\Carbon::parse($this->due_date)->format('d/m/Y')
            : null;
    }
}
