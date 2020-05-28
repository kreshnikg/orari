<?php


namespace App\Controller\Admin;

use App\AcademicYear;
use App\Controller\BaseController;
use App\Semester;
use App\Student;
use App\Subject;
use App\SubjectTeacher;
use App\SubjectType;
use App\Teacher;

class SubjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET["search"]))
            $subjects = Subject::with(['type'])->where('title', 'LIKE', '%' . $_GET["search"] . '%')->get();
        else
            $subjects = Subject::with(['type'])->select('*')->orderBy('subject_id', 'DESC')->get();

        return responseJson([
            'subjects' => $subjects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjectTypes = SubjectType::all();
        $semesters = Semester::all();

        return responseJson([
            "subjectTypes" => $subjectTypes,
            "semesters" => $semesters
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request, ["title", "code", "subject_type", "ects_credits","semester"]);
        $subjectType = SubjectType::find($request["subject_type"]);

        $subject = new Subject;
        $subject->title = $request["title"];
        $subject->code = $request["code"];
        $subject->ects_credits = $request["ects_credits"];
        $subject->semester_id = $request["semester"];
        $subject->subject_type_id = $subjectType->subject_type_id;
        $subject->save();

        return responseJson("success");
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
        $subjectTypes = SubjectType::all();
        $semesters = Semester::all();
        return responseJson([
            "subject" => $subject,
            "subjectTypes" => $subjectTypes,
            "semesters" => $semesters
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
        $this->validate($request, ["title", "code", "subject_type", "ects_credits","semester"]);
        $subjectType = SubjectType::find($request["subject_type"]);

        Subject::update($id, [
            "title" => $request["title"],
            "code" => $request["code"],
            "ects_credits" => $request["ects_credits"],
            "semester_id" => $request["semester"],
            "subject_type_id" => $subjectType->subject_type_id
        ]);

        return responseJson("success");
    }

    /**
     * Delete the specified resource in database.
     *
     * @param $request
     * @param integer $id
     */
    public function destroy($request, $id)
    {
        Subject::destroy($id);
        return responseJson("success");
    }

    public function registerTeachers()
    {
        $semesterId = 1;
        if (isset($_GET["semester"])) {
            $semesterId = $_GET["semester"];
        }
        $teachers = Teacher::with(['user'])->select('*')->get();
        $subjects = Subject::with(['subjectTeacher'])->where('semester_id','=',$semesterId)->get();
        $semesters = Semester::all();
        $studentCount = Student::where('semester_id','=',$semesterId)->get();

        return responseJson([
            "teachers" => $teachers,
            "subjects" => $subjects,
            "semesters" => $semesters,
            "studentCount" => count($studentCount)
        ]);
    }

    public function addSubjectTeacher($request)
    {
        $this->validate($request, ["subject","teachers"]);
        $subject = Subject::find($request["subject"]);
        $teacherIds = json_decode($request["teachers"]);
        $academicYear = AcademicYear::where('active','=',1)->first();

        SubjectTeacher::deleteWhere('subject_id','=',$subject->subject_id);
        foreach ($teacherIds as $teacherId) {
            $subjectTeacher = new SubjectTeacher();
            $subjectTeacher->academic_year_id = $academicYear->academic_year_id;
            $subjectTeacher->subject_id = $subject->subject_id;
            $subjectTeacher->teacher_id = $teacherId;
            $subjectTeacher->save();
        }
    }
}
