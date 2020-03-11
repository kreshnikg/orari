<?php


namespace App\Controller;

use App\Perdoruesi;

class PerdoruesiController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Perdoruesi::all();
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
        $this->validate($request, ['emri', 'mbiemri', 'email', 'fjalkalimi']);
        $user = new Perdoruesi;
        $user->emri = $request["emri"];
        $user->mbiemri = $request["mbiemri"];
        $user->email = $request["email"];
        $user->fjalkalimi = password_hash($request["fjalkalimi"], PASSWORD_DEFAULT);
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
