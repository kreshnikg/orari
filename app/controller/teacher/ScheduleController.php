<?php


namespace App\Controller\Teacher;


use App\Schedule;
use App\Semester;
use App\Subject;

class ScheduleController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semester = 1;
        if(isset($_GET["semester"]))
            $semester = $_GET["semester"];
        $schedules = Schedule::with(['type','group','classroom'])->where('semester_id','=',$semester)->get();
        $subjects = Subject::with(['subjectTeacher.teacher.user'])->where('semester_id', '=', $semester)->get();
        $semesters = Semester::all();
        return responseJson([
            "schedules" => $schedules,
            "subjects" => $subjects,
            "semesters" => $semesters,
            "teacherId" => user()->user_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
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
