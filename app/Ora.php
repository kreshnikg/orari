<?php


namespace App;


use Database\Model;

class Ora extends Model
{
    protected $table = 'ora';
    protected $primaryKey = 'ora_id';

    public function lloji()
    {
        $this->hasOne('App\OraLloji', 'ora_lloji_id', 'ora_lloji_id');
    }

    public function grupi()
    {
        $this->hasOne('App\Grupi', 'grupi_id', 'grupi_id');
    }

    public function lenda()
    {
        $this->hasOne('App\Lenda', 'lenda_id', 'lenda_id');
    }
}
