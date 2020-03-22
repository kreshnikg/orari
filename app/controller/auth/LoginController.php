<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Perdoruesi;

class LoginController extends BaseController
{
    /**
     * Show the login from.
     */
    public function form(){
        if(isAuthenticated())
            redirect('/');
        return view('auth/login',null,false);
    }

    /**
     * User login.
     * @param array $request
     */
    public function login($request)
    {
        $this->validate($request,['email','fjalkalimi']);
        $user = Perdoruesi::where('email', '=', $request["email"])->first();
        $success = false;
        if($user) {
            if (password_verify($request["fjalkalimi"], $user->fjalkalimi)) {
                $_SESSION["logged_in"] = true;
                setcookie("auth", "1",time()+3600,"/");
                setcookie("user", $user->emri . " " . $user->mbiemri,time()+3600,"/");
                $success = true;
            }
        }
        if($success){
            redirect('/');
        } else {
            response("Email ose fjalkalimi është gabim.",422);
        }
    }

    /**
     * Logout user and destroy session.
     */
    public function logout()
    {
        session_destroy();
        setcookie("auth", "", time()-3600);
        setcookie("user", "", time()-3600);
        redirect('/login');
    }
}
