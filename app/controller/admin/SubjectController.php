<?php


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Subject;
use App\SubjectType;

class SubjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET["search"]))
            $subjects = Subject::with(['type'])->where('title', 'LIKE', '%' . $_GET["search"] . '%')->get();
        else
            $subjects = Subject::with(['type'])->select('*')->get();
        return view('subjects/index',[
            'subjects' => $subjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjectTypes = SubjectType::all();
        return view('subjects/create',[
            "subjectTypes" => $subjectTypes
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["title","code","subject_type","ects_credits"]);
        $subjectType = SubjectType::find($request["subject_type"]);

        $subject = new Subject;
        $subject->title = $request["title"];
        $subject->code = $request["code"];
        $subject->ects_credits = $request["ects_credits"];
        $subject->subject_type_id = $subjectType->subject_type_id;
        $subject->save();

        return redirect("/admin/subjects",[
            "success" => "Lënda u krijua me sukses!"
        ]);
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
        $subject = Subject::with(['type'])->find($id);
        $subjectTypes = SubjectType::all();
        return view("subjects/edit",[
            "subject" => $subject,
            "subjectTypes" => $subjectTypes
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
        $this->validate($request,["title","code","subject_type","ects_credits"]);
        $subjectType = SubjectType::find($request["subject_type"]);

        Subject::update($id,[
            "title" => $request["title"],
            "code" => $request["code"],
            "ects_credits" => $request["ects_credits"],
            "subject_type_id" => $subjectType->subject_type_id
        ]);

        return redirect("/admin/subjects",[
            "success" => "Ndryshimet u ruajtën me sukses!"
        ]);
    }

    /**
     * Delete the specified resource in database.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
        Subject::delete($id);
        return redirect("/admin/subjects",[
            "success" => "Lënda u fshi me sukses!"
        ]);
    }
}
