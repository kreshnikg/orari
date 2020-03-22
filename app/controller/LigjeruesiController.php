<?php


namespace App\Controller;


use App\Ligjeruesi;

class LigjeruesiController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ligjeruesit = Ligjeruesi::with(['perdoruesi','lloji'])->select('*')->get();
        return view('ligjeruesit/index',[
            'ligjeruesit' => $ligjeruesit
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
