<?php


namespace App;

use Database\Model;

class Studenti extends Model
{
    protected $table = 'studenti';
    protected $primaryKey = 'studenti_id';

    public function perdoruesi($nestedRelations = null)
    {
        $this->hasOne('App\Perdoruesi', 'perdoruesi_id', 'studenti_id',$nestedRelations);
    }

    public function gjenerata($nestedRelations = null)
    {
        $this->hasOne('App\Gjenerata', 'gjenerata_id', 'gjenerata_id',$nestedRelations);
    }

    public function semestri($nestedRelations = null)
    {
        $this->hasOne('App\Semestri', 'semestri_id', 'semestri_id',$nestedRelations);
    }
    public function grupi($nestedRelations = null)
    {
        $this->hasOne('App\Grupi', 'grupi_id', 'grupi_id',$nestedRelations);
    }
}
