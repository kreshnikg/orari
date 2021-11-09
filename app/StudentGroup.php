<?php


namespace App;

use App\Database\Model;

class StudentGroup extends Model
{
    protected $table = 'student_group';
    protected $primaryKey = 'student_group_id';
    protected $timestamps = false;
    public function group($nestedRelations = null)
    {
        $this->hasOne('App\Group', 'group_id', 'group_id',$nestedRelations);
    }

    public function student($nestedRelations = null)
    {
        $this->hasOne('App\Student', 'student_id', 'student_id',$nestedRelations);
    }
}
