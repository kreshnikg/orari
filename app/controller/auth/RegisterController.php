<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
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

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = password_hash($request->password,PASSWORD_DEFAULT);
        $user->save();

        $login = new LoginController;
        return $login->login($request);
    }
}
