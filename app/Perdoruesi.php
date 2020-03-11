<?php


namespace App;

use Database\Model;

class Perdoruesi extends Model
{
    protected $table = 'perdoruesi';
    protected $primaryKey = 'perdoruesi_id';
    public $timestamps = false;

    public function roli()
    {
        $this->hasOne('App\Roli', 'roli_id', 'roli_id');
    }
}
