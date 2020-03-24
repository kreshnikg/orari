<?php


namespace App;

use Database\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $primaryKey = 'semester_id';

    public function studyYear($nestedRelations = null)
    {
        $this->hasOne('App\StudyYear', 'study_year_id', 'study_year_id',$nestedRelations);
    }
}
