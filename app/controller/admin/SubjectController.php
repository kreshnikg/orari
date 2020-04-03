<?php


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Subject;

class SubjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET["search"]))
            $subjects = Subject::where('title', 'LIKE', '%' . $_GET["search"] . '%')->get();
        else
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
        $subject->title = $request["title"];
        $subject->code = $request["code"];
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
        $subject = Subject::find($id);
        return view("subjects/edit",[
            "subject" => $subject
        ]);
    }

    /**
     * Update the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function update($request, $id)
    {
        $this->validate($request,["title","code"]);

        Subject::update($id,[
            "title" => $request["title"],
            "code" => $request["code"]
        ]);

        return redirect("/subjects");
    }

    /**
     * Delete the specified resource in database.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
        Subject::delete($id);
        return redirect("/subjects");
    }
}
