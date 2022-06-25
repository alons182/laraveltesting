<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function add($user)
    {
        $this->preventTooManyUsers();
        $method = $user instanceof User ? 'save' : 'saveMany';
        return $this->members()->$method($user);
    }

    // Remove an specific user
    public function removeUser($user)
    {
        return $this->members()->get()->find($user->id)->delete();
    }

    // 
    public function removeUsers()
    {
        return $this->members()->delete();
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function preventTooManyUsers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception('Ohh Error');
        }
    }
}
