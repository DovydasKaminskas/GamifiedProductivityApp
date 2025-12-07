<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'task_name',
        'type',
        'due_to',
        'priority',
        'xp',
        'user_id',
        'on_time'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
