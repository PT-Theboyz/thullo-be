<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    public $fillable  = [
        'name', 'board_id'
    ];

    public $table = 'task_lists';

    
}
