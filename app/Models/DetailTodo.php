<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTodo extends Model
{
    use HasFactory;

    protected $fillable  = [
        'detail_pengerjaan', 
        'progress_pengerjaan',
        'hasil', 
        'status', 
        'due_date', 
        'attachment', 
        'todo_id', 
        'note'
    ];
}
