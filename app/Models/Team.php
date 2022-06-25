<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;



class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

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



    public function unsetUser($user)
    {
        $method = $user instanceof User ? 'destroy' : 'saveMany';
        return $this->members()->$method($user);
    }


    public function unsetAllUsers($user)
    {
        $method = $user instanceof User ? 'delete' : 'saveMany';
        return $this->members()->$method($user);
    }


    public function softDelete($user)
    {
        foreach ($user as $team) {
            echo $user->name;
            $user->softDeletes();
        }
    }



}
