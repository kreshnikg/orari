<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Controller\UserController;
use App\User;

class RegisterController extends BaseController
{
    /**
     * Show the register form
     */
    public function form()
    {
        if(isAuthenticated())
            redirect('/');
        return view('auth/register',null,false);
    }

    /**
     * Register new user.
     *
     * @param array $request
     */
    public function register($request)
    {
        $this->validate($request,['first_name','last_name','email','password']);

        $exists = User::where('email', '=', $request['email'])->first();
        if($exists)
            response("Perdoruesi ekziston.",422);

        UserController::createUser(
            $request["first_name"],
            $request["last_name"],
            $request["email"],
            $request["password"]
        );

        $login = new LoginController;
        return $login->login($request);
    }
}
