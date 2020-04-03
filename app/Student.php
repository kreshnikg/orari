<?php


namespace App;

use App\Database\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';

    public function user($nestedRelations = null)
    {
        $this->hasOne('App\User', 'user_id', 'student_id',$nestedRelations);
    }

    public function generation($nestedRelations = null)
    {
        $this->hasOne('App\Generation', 'generation_id', 'generation_id',$nestedRelations);
    }

    public function semester($nestedRelations = null)
    {
        $this->hasOne('App\Semester', 'semester_id', 'semester_id',$nestedRelations);
    }

    public function group($nestedRelations = null)
    {
        $this->hasOne('App\Group', 'group_id', 'group_id',$nestedRelations);
    }
}
