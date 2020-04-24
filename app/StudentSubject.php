<?php


namespace App;

use App\Database\Model;

class StudentSubject extends Model
{
    protected $table = 'student_subject';
    protected $primaryKey = 'student_subject_id';

    public function subject($nestedRelations = null)
    {
        $this->hasOne('App\Subject', 'subject_id', 'subject_id',$nestedRelations);
    }

    public function student($nestedRelations = null)
    {
        $this->hasOne('App\Student', 'student_id', 'student_id',$nestedRelations);
    }
}
