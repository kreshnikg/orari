<?php


namespace App;

use Database\Model;


class Ligjeruesi extends Model
{
    protected $table = 'ligjeruesi';
    protected $primaryKey = 'ligjeruesi_id';

    public function perdoruesi()
    {
        $this->hasOne('App\Perdoruesi', 'perdoruesi_id', 'ligjeruesi_id');
    }

    public function lloji()
    {
        $this->hasOne('App\LigjeruesiLloji', 'ligjeruesi_lloji_id', 'ligjeruesi_lloji_id');
    }
}
