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

    public function labels(){
        return $this->belongsToMany(Label::class)->withTimestamps();
    }

    public function checkLists()
    {
        return $this->hasMany(CheckList::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    protected function Board(){
        return $this->belongsTo(Board::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($task) { 
            $task->labels()->each(function($label) {
                $label->delete(); 
            });

            $task->checkLists()->each(function($checklist) {
                $checklist->delete(); 
            });

            $task->attachments()->each(function($attachment) {
                $attachment->delete(); 
            });
        });
    }
}
