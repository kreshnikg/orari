<?php


namespace App;

use App\Database\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';

    public function user($nestedRelations = null)
    {
        $this->hasOne('App\User', 'user_id', 'student_id', $nestedRelations);
    }

    public function semester($nestedRelations = null)
    {
        $this->hasOne('App\Semester', 'semester_id', 'semester_id', $nestedRelations);
    }

    public function studentGroup($nestedRelations = null)
    {
        $this->hasMany('App\StudentGroup', 'student_id', 'student_id', $nestedRelations);
    }

    public function studentSubject($nestedRelations = null)
    {
        $this->hasMany('App\StudentSubject', 'student_id', 'student_id', $nestedRelations);
    }
}
