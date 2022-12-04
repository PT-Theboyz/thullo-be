<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name', 'board_id'
    ];

    protected $table = 'task_lists';

    protected function Board(){
        return $this->belongsTo(Board::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('position', 'asc');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($tasklist) { 
            $tasklist->tasks()->each(function($task) {
                $task->delete(); 
            });
        });
    }
}