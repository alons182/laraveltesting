<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
       return '/projects/'.$this->id;
    }

    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
