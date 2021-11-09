<?php


namespace App\Controller;

use App\User;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users/create');
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request, ['first_name', 'last_name', 'email', 'password']);
        self::createUser(
            $request['first_name'],
            $request['last_name'],
            $request['email'],
            $request['password']
        );
        return redirect('/users');
    }

    /**
     * Create user and return user_id.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param integer|null $roleId
     * @return string
     */
    public static function createUser($firstName,$lastName,$email,$password,$roleId = null)
    {
        $user = new User;
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);

        if($roleId != null)
            $user->role_id = $roleId;

        return $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     */
    public function show($id)
    {
        die("Show id: $id");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     */
    public function edit($id)
    {
        die("Edit id: $id");
    }

    /**
     * Update the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function update($request, $id)
    {
        echo "Request:" . json_encode($request) . "<br>";
        echo "Id: $id" . "<br>";
        die();
    }

    /**
     * Delete the specified resource in database.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
    }
}
