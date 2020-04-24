<?php


namespace App;

use App\Database\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subject_id';

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\SubjectType', 'subject_type_id', 'subject_type_id', $nestedRelations);
    }
}
