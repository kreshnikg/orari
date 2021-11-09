<?php


namespace App\Controller;


use App\Role;
use App\Semester;
use App\Student;
use App\User;

class StudentController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user','semester'])->select('*')->get();
        return responseJson([
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semester = Semester::where('number','=',1)->first();
        return responseJson([
            'semester' => $semester
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request, ["first_name","last_name","email","password"]);
        $role = Role::where('title','=','student')->first();
        $semester = Semester::where('number','=',1)->first();

        $userId = UserController::createUser(
            $request["first_name"],
            $request["last_name"],
            $request["email"],
            $request["password"],
            $role->role_id
        );

        $student = new Student;
        $student->student_id = $userId;
        $student->semester_id = $semester->semester_id;
        $student->save();

        return redirect("/admin/students");
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
        $student = Student::with(['user','generation'])->where('student_id','=',$id)->first();
        $semesters = Semester::all();
        return responseJson([
            'student' => $student,
            'semesters' => $semesters
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
        $this->validate($request,["first_name","last_name","email","semester"]);
        $semester = Semester::find($request["semester"]);

        User::update($id,[
            'first_name' => $request["first_name"],
            'last_name' => $request["last_name"],
            'email' => $request["email"],
        ]);

        Student::update($id,[
            'semester_id' => $semester->semester_id
        ]);

        return responseJson([
            "success" => "Ndryshimet u ruajtën me sukses."
        ]);
    }

    /**
     * Delete the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function destroy($request, $id)
    {
        Student::destroy($id);
        return responseJson("success");
    }
}
