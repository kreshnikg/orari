<?php


namespace App;

use App\Database\Model;


class Teacher extends Model
{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';

    public function user($nestedRelations = null)
    {
        $this->hasOne('App\User', 'user_id', 'teacher_id',$nestedRelations);
    }

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\TeacherType', 'teacher_type_id', 'teacher_type_id',$nestedRelations);
    }
}
