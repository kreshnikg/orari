<?php


namespace App\Controller;


use App\Subject;
use App\User;

class SubjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects/index',[
            'subjects' => $subjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects/create');
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["title","code"]);

        $subject = new Subject;
        $subject->emertimi = $request["title"];
        $subject->kodi = $request["code"];
        $subject->save();

        return redirect("/subjects");
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
