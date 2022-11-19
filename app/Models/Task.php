<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable  = [
        'title', 'description', 'position', 'status',
        'due_date', 'cover', 'board_id', 'task_list_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
