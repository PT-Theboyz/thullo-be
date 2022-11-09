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

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
