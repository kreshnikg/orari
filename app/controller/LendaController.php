<?php


namespace App\Controller;


use App\Lenda;

class LendaController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lendet = Lenda::all();
        return view('lendet/index',[
            'lendet' => $lendet
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lendet/create');
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["emertimi","kodi"]);

        $lenda = new Lenda;
        $lenda->emertimi = $request["emertimi"];
        $lenda->kodi = $request["kodi"];
        $lenda->save();

        return redirect("/lendet");
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
