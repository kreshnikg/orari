<?php


namespace App;

use Database\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $primaryKey = 'schedule_id';

    public function type($nestedRelations = null)
    {
        $this->hasOne('App\ScheduleType', 'schedule_type_id', 'schedule_type_id',$nestedRelations);
    }
}
