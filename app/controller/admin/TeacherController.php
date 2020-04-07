<?php


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Controller\UserController;
use App\Role;
use App\Teacher;
use App\TeacherType;
use App\User;

class TeacherController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with(['user','type'])->select('*')->get();
        return view('teachers/index',[
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacherTypes = TeacherType::all();
        return view('teachers/create', [
            'teacherTypes' => $teacherTypes
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request,["first_name","last_name","email","password","teacher_type"]);
        $role = Role::where('title','=','teacher')->first();
        $teacherType = TeacherType::find($request["teacher_type"]);

        $userId = UserController::createUser(
            $request["first_name"],
            $request["last_name"],
            $request["email"],
            $request["password"],
            $role->role_id
        );

        $teacher = new Teacher;
        $teacher->teacher_id = $userId;
        $teacher->teacher_type_id = $teacherType->teacher_type_id;
        $teacher->save();

        return redirect("/teachers");
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     */
    public function show($id)
    {
        $teacher = Teacher::with(["user","type"])->where('teacher_id','=',$id)->first();
        return view("teachers/show",[
            "teacher" => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     */
    public function edit($id)
    {
        $teacher = Teacher::with(["user","type"])->where('teacher_id','=',$id)->first();
        $teacherTypes = TeacherType::all();
        return view("teachers/edit",[
            "teacher" => $teacher,
            "teacherTypes" => $teacherTypes
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
        $this->validate($request,["first_name","last_name","email","teacher_type"]);
        $teacherType = TeacherType::find($request["teacher_type"]);

        User::update($id, [
            'first_name' => $request["first_name"],
            'last_name' => $request["last_name"],
            'email' => $request["email"]
        ]);

        Teacher::update($id, [
            'teacher_type_id' => $teacherType->teacher_type_id
        ]);

        return redirect("/admin/teachers",[
            "success" => "Ndryshimet u ruajtën me sukses."
        ]);
    }

    /**
     * Delete the specified resource in database.
     *
     * @param integer $id
     */
    public function destroy($id)
    {
        Teacher::delete($id);
        return redirect("/teachers");
    }
}
