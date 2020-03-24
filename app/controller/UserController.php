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

        $user = new User;
        $user->first_name = $request["first_name"];
        $user->last_name = $request["last_name"];
        $user->email = $request["email"];
        $user->password = password_hash($request["password"], PASSWORD_DEFAULT);
        $user->save();

        return redirect('/users');
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
