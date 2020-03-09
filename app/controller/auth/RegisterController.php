<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Perdoruesi;

class RegisterController extends BaseController
{
    /**
     * Show the register form
     */
    public function form()
    {

    }

    public function register($request)
    {
        $this->validate($request,['emri','mbiemri','email','fjalkalimi']);
        $user = new Perdoruesi;
        $user->emri = $request->emri;
        $user->mbiemri = $request->mbiemri;
        $user->email = $request->email;
        $user->fjalkalimi = password_hash($request->fjalkalimi,PASSWORD_DEFAULT);
        $user->save();

        $login = new LoginController;
        return $login->login($request);
    }
}
