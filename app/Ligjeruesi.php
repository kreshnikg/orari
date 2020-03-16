<?php


namespace App;

use Database\Model;


class Ligjeruesi extends Model
{
    protected $table = 'ligjeruesi';
    protected $primaryKey = 'ligjeruesi_id';

    public function perdoruesi($nestedRelations = null)
    {
        $this->hasOne('App\Perdoruesi', 'perdoruesi_id', 'ligjeruesi_id',$nestedRelations);
    }

    public function lloji($nestedRelations = null)
    {
        $this->hasOne('App\LigjeruesiLloji', 'ligjeruesi_lloji_id', 'ligjeruesi_lloji_id',$nestedRelations);
    }
}
