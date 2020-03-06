<?php


namespace App;

use Database\Model;

class Lenda extends Model
{
    protected $table = 'lenda';
    protected $primaryKey = 'lenda_id';

    public function ligjeruesi()
    {
        $this->hasOne('App\Ligjeruesi','ligjeruesi_id','ligjeruesi_id');
    }
}
