<?php


namespace App;

use Database\Model;

class Studenti extends Model
{
    protected $table = 'studenti';
    protected $primaryKey = 'studenti_id';

    public function perdoruesi()
    {
        $this->hasOne('App\Perdoruesi', 'perdoruesi_id', 'studenti_id');
    }

    public function grupi()
    {
        $this->hasOne('App\Grupi', 'grupi_id', 'grupi_id');
    }
}
