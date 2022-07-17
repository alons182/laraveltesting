<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function add($users)
    {
       
        $this->preventTooManyUsers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        return $this->members()->$method($users);
        
        // if($user instanceof User){
        //     return $this->members()->save($user);
        // }

        // return $this->members()->saveMany($user);
    }

    public function remove($users = null)
    {
        if($users instanceof User){
            return $users->leaveTeam();
        }

        return $this->removeMany($users);
  
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

    public function preventTooManyUsers($users)
    {
        $usersToAdd = $users instanceof User ? 1 : $users->count();
        $teamUsersCount = $this->count() + $usersToAdd;


        if($teamUsersCount > $this->size){
            throw new \Exception('Ohh Error');
        }
    }

}
