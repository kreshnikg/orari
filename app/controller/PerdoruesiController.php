<?php


namespace App\Controller;
use App\Perdoruesi;

class PerdoruesiController
{
    public function index()
    {
        $users = Perdoruesi::all();
        return view('index.php',[
            'users' => $users
        ]);
    }
}
