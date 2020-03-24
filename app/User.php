<?php


namespace App;

use Database\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    public function role($nestedRelations = null)
    {
        $this->hasOne('App\Role', 'role_id', 'role_id',$nestedRelations);
    }
}
