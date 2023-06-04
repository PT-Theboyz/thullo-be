<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name', 'check_list_id', 'status_finish', 'due_date', 'status_date', 'status'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }


    public function detailTodos()
    {
        return $this->hasMany(DetailTodo::class);
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($todo) { 
            $todo->detailTodos()->each(function($detailTodo) {
                $detailTodo->delete(); 
            });
        });
    }
}
