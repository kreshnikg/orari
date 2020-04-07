<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\User;

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
        $this->validate($request,['email','password']);
        $user = User::with(['role'])->where('email', '=', $request["email"])->first();
        $success = false;
        if($user) {
            if (password_verify($request["password"], $user->password)) {
                $_SESSION["logged_in"] = true;
                $userData = [
                    "name" => "$user->first_name $user->last_name",
                    "user_id" => $user->user_id,
                    "role" => $user->role->title
                ];
                setcookie("auth", "1",time()+3600,"/");
                setcookie("user", json_encode($userData),time()+3600,"/");
                $success = true;
            }
        }
        if($success){
            redirect('/');
        } else {
            redirectBack([
                "error" => "Email ose fjalkalimi është gabim."
            ]);
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
