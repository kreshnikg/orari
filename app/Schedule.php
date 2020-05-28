<?php


namespace App;

use App\Database\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'schedule_id';
    protected $timestamps = false;

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\ScheduleType', 'schedule_type_id', 'schedule_type_id', $nestedRelations);
    }

    public function subjectTeacher($nestedRelations = null)
    {
        $this->hasOne('App\SubjectTeacher', 'subject_teacher_id', 'subject_teacher_id', $nestedRelations);
    }

    public function academicYear($nestedRelations = null)
    {
        $this->hasOne('App\AcademicYear', 'academic_year_id', 'academic_year_id', $nestedRelations);
    }

    public function group($nestedRelations = null)
    {
        $this->hasOne('App\Group', 'group_id', 'group_id', $nestedRelations);
    }

    public function classroom($nestedRelations = null)
    {
        $this->hasOne('App\Classroom', 'classroom_id', 'classroom_id', $nestedRelations);
    }
}
