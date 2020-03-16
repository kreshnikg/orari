<?php


namespace App;

use Database\Model;

class Perdoruesi extends Model
{
    protected $table = 'perdoruesi';
    protected $primaryKey = 'perdoruesi_id';
    public $timestamps = false;

    public function roli($nestedRelations = null)
    {
        $this->hasOne('App\Roli', 'roli_id', 'roli_id',$nestedRelations);
    }
}
