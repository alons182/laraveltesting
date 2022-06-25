<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Function_;

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

    public function de($user)
    {



        $method = $user instanceof User ? 'delete' : 'saveMany';

        return $this->members()->$method($user);

        // if($user instanceof User){
        //     return $this->members()->save($user);
        // }

        // return $this->members()->saveMany($user);
    }

    public function du($user)
    {



        $method = $user instanceof User ? 'unset' : 'unset';

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

    // public function aaa()
    // {
    //     return $this->ayuda($this->members);
    // }


    // public Function ayuda(){

    //     unset($this->team[1]);

    // }

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
