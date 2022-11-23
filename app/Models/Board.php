<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'cover', 'description'
    ];

     // Get the entries for a specific mood.
    public function taskLists()
    {
        return $this->hasMany(TaskList::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    protected static function booted()
    {
        static::saving(function() {
            Cache::forget('allBoards');
        });

        static::deleted(function() {
            Cache::forget('allBoards');
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($board) { 
            $board->tasks()->each(function($task) {
                $task->delete(); 
            });
            
            $board->taskLists()->each(function($tasklist) {
                $tasklist->delete(); 
            });
        });
    }
}
