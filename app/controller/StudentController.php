<?php


namespace App\Controller;


use App\Generation;
use App\Role;
use App\Semester;
use App\Student;

class StudentController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user','generation','semester.studyYear'])->select('*')->get();
        return view('students/index',[
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generation = Generation::where('year','=',date('Y'))->first();
        $semester = Semester::where('number','=',1)->first();
        return view("students/create", [
            'generation' => $generation,
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
        $generation = Generation::where('year','=',date('Y'))->first();
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
        $student->generation_id = $generation->generation_id;
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
        Student::delete($id);
        return redirect("/admin/students");
    }
}
