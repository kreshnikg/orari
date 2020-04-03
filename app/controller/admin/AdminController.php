<?php


namespace App\Controller\Admin;


use App\User;

class AdminController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id','=',1)->get();
        return view('admins/index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins/create');
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
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
     * @param integer $id
     */
    public function destroy($id)
    {
    }
}
