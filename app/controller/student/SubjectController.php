<?php


namespace App\Controller\Student;

use App\Controller\BaseController;
use App\Student;
use App\StudentSubject;
use App\Subject;

class SubjectController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::with(['studentSubject'])->where('student_id','=',user()->user_id)->first();
        $subjects = Subject::with(['type'])->where('semester_id','=',$student->semester_id)->get();
        return responseJson([
            'subjects' => $subjects,
            'student' => $student
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
     * @param $request
     * @param integer $id
     */
    public function register($request, $id)
    {
        $subject = Subject::find($id);
        $student = Student::find(user()->user_id);

        $studentSubject = new StudentSubject;
        $studentSubject->student_id = $student->student_id;
        $studentSubject->subject_id = $subject->subject_id;
        $studentSubject->save();

        return redirectBack();
    }

    /**
     * @param $request
     * @param integer $id
     */
    public function cancel($request, $id)
    {
        $subject = Subject::find($id);
        $student = Student::find(user()->user_id);

        $studentSubject = StudentSubject::where('student_id','=',$student->student_id)->where('subject_id','=',$subject->subject_id)->first();
        StudentSubject::destroy($studentSubject->student_subject_id);

        return redirectBack();
    }

    /**
     *
     */
    public function submit()
    {
        $student = Student::find(user()->user_id);
        Student::update($student->student_id,[
            "subjects_registered" => 1
        ]);
        return redirectBack();
    }
}
