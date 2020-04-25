<?php


namespace App;

use App\Database\Model;

class Classroom extends Model
{
    protected $table = 'classroom';
    protected $primaryKey = 'classroom_id';

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\ClassroomType', 'classroom_type_id', 'classroom_type_id',$nestedRelations);
    }
}
