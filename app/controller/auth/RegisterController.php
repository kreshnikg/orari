<?php


namespace App\Controller\Auth;

use App\Controller\BaseController;
use App\Controller\UserController;
use App\Student;
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
        return view('layout/app',"",false);
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

        if($exists){
            return redirectBack([
                "error" => "Email i dhënë është në përdorim."
            ]);
        }

        $userId = UserController::createUser(
            $request["first_name"],
            $request["last_name"],
            $request["email"],
            $request["password"],
            3
        );

        $student = new Student;
        $student->student_id = $userId;
        $student->semester_id = 1;
        $student->save();

        $login = new LoginController;
        return $login->login($request);
    }
}
