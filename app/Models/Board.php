<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
