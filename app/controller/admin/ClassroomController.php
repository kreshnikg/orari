<?php


namespace App\Controller\Admin;


use App\Classroom;
use App\ClassroomType;
use App\Controller\BaseController;

class ClassroomController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::with(['type'])->select('*')->get();
        return view('classrooms/index',[
            "classrooms" => $classrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroomTypes = ClassroomType::all();
        return view('classrooms/create', [
            "classroomTypes" => $classroomTypes,
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["number","classroom_type"]);

        $classroomType = ClassroomType::find($request["classroom_type"]);

        $classroom = new Classroom;
        $classroom->number = $request["number"];
        $classroom->classroom_type_id = $classroomType->classroom_type_id;
        $classroom->save();

        return redirect("/admin/classrooms",[
            "success" => "Klasa u krijua me sukses!"
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
        $classroom = Classroom::with(['type'])->find($id);
        $classroomTypes = ClassroomType::all();
        return view("classrooms/edit",[
            "classroom" => $classroom,
            "classroomTypes" => $classroomTypes
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
        $this->validate($request,["number","classroom_type"]);

        $classroomType = ClassroomType::find($request["classroom_type"]);
        Classroom::update($id, [
            "number" => $request["number"],
            "classroom_type_id" => $classroomType->classroom_type_id
        ]);
        
        return redirect("/admin/classrooms",[
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
        Classroom::delete($id);
        return redirect("/admin/classrooms",[
            "success" => "Klasa u fshi me sukses!"
        ]);
    }
}
