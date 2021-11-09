<?php


namespace App\Controller\Admin;

use App\Classroom;
use App\Controller\BaseController;
use App\Group;
use App\Schedule;
use App\ScheduleType;
use App\Semester;
use App\Subject;
use App\SubjectTeacher;

class ScheduleController extends BaseController
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
            "semesters" => $semesters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Semester::all();
        $classrooms = Classroom::with(['type'])->select('*')->get();
        $subjects = Subject::with(['subjectTeacher.teacher.user'])->where('semester_id','=',1)->get();
        $scheduleTypes = ScheduleType::all();
        $groups = Group::with(['type'])->where('semester_id','=',1)->get();

        return responseJson([
            "semesters" => $semesters,
            "subjects" => $subjects,
            "classrooms" => $classrooms,
            "scheduleTypes" => $scheduleTypes,
            "groups" => $groups
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $schedule = new Schedule();
        $schedule->day_of_week = $request["dayOfWeek"];
        $schedule->start_time = $request["startTime"];
        $schedule->end_time = $request["endTime"];
        $schedule->schedule_type_id = $request["scheduleType"];
        $schedule->subject_teacher_id = $request["subjectTeacher"];
        $schedule->semester_id = $request["semester"];
        $schedule->classroom_id = $request["classroom"];
        $schedule->group_id = $request["group"];
        $schedule->academic_year_id = 2;
        $schedule->save();
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
     * @param $request
     * @param integer $id
     */
    public function destroy($request, $id)
    {
        Schedule::destroy($id);
    }
}
