<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckList extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name', 'task_id'
    ];

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($checklist) { 
            $checklist->todos()->each(function($todo) {
                $todo->delete(); 
            });
        });
    }

    protected $table = 'check_lists';
}
