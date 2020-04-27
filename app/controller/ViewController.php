<?php


namespace App\Controller;


class ViewController
{
    public function defaultView(){
        return view('layout/app',"",false);
    }
}
