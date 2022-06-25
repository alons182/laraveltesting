<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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

    public function remove($userRecibido, $teamId){

        User::where('id', $userRecibido->id)->update(['team_id' => null]);

        $team = User::where('team_id', $teamId)->get();
        return $team->count();

    }

    public function removeAll($teamId){
        foreach(User::all() as $user){
            $user->update(['team_id' => null]);
        }

        $team = User::where('team_id', $teamId)->get();
        return $team->count();
        
    }

}
