<?php


namespace App;

use Database\Model;

class Semestri extends Model
{
    protected $table = 'semestri';
    protected $primaryKey = 'semestri_id';

    public function viti($nestedRelations = null)
    {
        $this->hasOne('App\Viti', 'viti_id', 'viti_id',$nestedRelations);
    }
}
