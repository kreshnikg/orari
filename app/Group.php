<?php


namespace App;

use App\Database\Model;

class Group extends Model
{
    protected $table = 'group';
    protected $primaryKey = 'group_id';

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\GroupType', 'group_type_id', 'group_type_id', $nestedRelations);
    }

    public function semester($nestedRelations = null)
    {
        $this->hasOne('App\Semester', 'semester_id', 'semester_id', $nestedRelations);
    }

    public function studentGroup($nestedRelations = null)
    {
        $this->hasMany('App\StudentGroup', 'group_id', 'group_id', $nestedRelations);
    }
}
