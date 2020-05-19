<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Role;
use App\User;

class AdminController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id','=',1)->get();
        return responseJson([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["first_name","last_name","email","password"]);

        $role = Role::where('title','=','admin')->first();

        $user = new User;
        $user->first_name = $request["first_name"];
        $user->last_name = $request["last_name"];
        $user->email = $request["email"];
        $user->password = $request["password"];
        $user->role_id = $role->role_id;
        $user->save();

        return responseJson("success");
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function update($request, $id)
    {
    }

    /**
     * Delete the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function destroy($request, $id)
    {
        if($id == 1){
           return responseJson("Error",422);
        }
        User::destroy($id);
        return responseJson("success");
    }
}
