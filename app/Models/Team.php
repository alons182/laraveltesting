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
        
        // if($user instanceof User){
        //     return $this->members()->save($user);
        // }

        // return $this->members()->saveMany($user);
    }

    public function remove($users = null)
    {
        if($users instanceof User){
            $users->leaveTeam();
        }

        $this->removeMany($users);
  
    }

    public function removeMany($users)
    {
        return $this->members()
                    ->whereIn('id', $users->pluck('id'))
                    ->update(['team_id' => null]);
    }

    public function reset()
    {
    
        return $this->members()->update(['team_id' => null]);
    
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
        if($this->count() >= $this->size){
            throw new \Exception('Ohh Error');
        }
    }

}
