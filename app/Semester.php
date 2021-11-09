<?php


namespace App;

use App\Database\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $primaryKey = 'semester_id';

    public function group($nestedRelations = null)
    {
        $this->hasMany('App\Group', 'semester_id', 'semester_id', $nestedRelations);
    }
}
