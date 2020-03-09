<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Perdoruesi;

class LoginController extends BaseController
{
    /**
     * Show the login from
     */
    public function form(){
        return view('login');
    }

    public function login($request)
    {
        $this->validate($request,['email','fjalkalimi']);
        $userData = Perdoruesi::where('email', '=', $request->email)->get();
        $success = true;
        if(count($userData) == 1) {
            $user = $userData[0];
            if (password_verify($request->fjalkalimi, $user->fjalkalimi)) {
                $_SESSION["logged_in"] = true;
                setcookie("user", json_encode(["emri" => $user->emri,"mbiemri" => $user->mbiemri]),time()+3600,"/");
            } else {
                $success = false;
            }
        } else {
            $success = false;
        }
        if($success){
            return "success";
        } else {
            response("Email ose fjalkalimi është gabim.",422);
        }
    }

    public function logout()
    {
        session_destroy();
        setcookie("user", "", time()-3600);
        return "success";
    }
}
