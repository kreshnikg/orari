<?php


namespace App;


use Database\Model;

class Ora extends Model
{
    protected $table = 'ora';
    protected $primaryKey = 'ora_id';

    public function lloji($nestedRelations = null)
    {
        $this->hasOne('App\OraLloji', 'ora_lloji_id', 'ora_lloji_id',$nestedRelations);
    }

    public function grupi($nestedRelations = null)
    {
        $this->hasOne('App\Grupi', 'grupi_id', 'grupi_id',$nestedRelations);
    }

    public function lenda($nestedRelations = null)
    {
        $this->hasOne('App\Lenda', 'lenda_id', 'lenda_id',$nestedRelations);
    }
}
