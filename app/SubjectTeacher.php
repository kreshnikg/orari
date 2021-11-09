<?php


namespace App;

use App\Database\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subject_teacher';
    protected $primaryKey = 'subject_teacher_id';

    public function subject($nestedRelations = null)
    {
        $this->hasOne('App\Subject', 'subject_id', 'subject_id',$nestedRelations);
    }

    public function teacher($nestedRelations = null)
    {
        $this->hasOne('App\Teacher', 'teacher_id', 'teacher_id',$nestedRelations);
    }

    public function academicYear($nestedRelations = null)
    {
        $this->hasOne('App\AcademicYear', 'academic_year_id', 'academic_year_id',$nestedRelations);
    }
}
