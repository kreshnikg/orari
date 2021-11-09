<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Group;
use App\GroupType;
use App\Semester;
use App\Student;
use App\StudentGroup;

class GroupController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::with(['type', 'semester','studentGroup'])->select('*')->get();
        return responseJson([
            'groups' => $groups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Semester::with(['group'])->select(['semester_id', 'number', 'description'])->get();

        return responseJson([
            'semesters' => $semesters
        ]);
    }

    public function getStudentsCount($semesterId)
    {
        $students = Student::where('semester_id', '=', $semesterId)->get();

        responseJson([
            "studentsCount" => count($students)
        ]);
    }

    /**
     * Store the newly created resource in database.
     *
     * @param $request
     */
    public function store($request)
    {
        $this->validate($request, ["nr_groups_lecture", "nr_groups_practice", "semester_id"]);

        $nrGroupsLecture = (int)$request["nr_groups_lecture"];
        $nrGroupsPractice = (int)$request["nr_groups_practice"];

        $semester = Semester::find($request["semester_id"]);

        $students = Student::where('semester_id', '=', $semester->semester_id)->get();

        if ($nrGroupsLecture > 0) {
            $groupType = GroupType::where('title', '=', 'L')->first();

            $this->createGroups($students, $nrGroupsLecture, $groupType, $semester);
        }

        if($nrGroupsPractice > 0) {
            $groupType = GroupType::where('title', '=', 'U')->first();

            $this->createGroups($students, $nrGroupsPractice, $groupType, $semester);
        }
    }

    private function createGroups($students, $nrGroups, $groupType, $semester)
    {
        $groupsOfStudents = partition($students, $nrGroups);

        for ($i = 0; $i < $nrGroups; $i++) {
            $group = new Group;
            $group->number = $i + 1;
            $group->group_type_id = $groupType->group_type_id;
            $group->semester_id = $semester->semester_id;
            $newGroupId = $group->save();

            foreach ($groupsOfStudents[$i] as $student) {
                $studentGroup = new StudentGroup;
                $studentGroup->student_id = $student->student_id;
                $studentGroup->group_id = $newGroupId;
                $studentGroup->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     */
    public function show($id)
    {
        $group = Group::find($id);
        $studentGroup = StudentGroup::with(['student.user'])->where('group_id','=',$group->group_id)->get();
        return responseJson([
            'group' => $group,
            'studentGroup' => $studentGroup
        ]);
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
     * @param $request
     * @param integer $id
     */
    public function destroy($request, $id)
    {
        $group = Group::find($id);
        StudentGroup::deleteWhere('group_id','=',$group->group_id);
        Group::destroy($id);
        return responseJson("success");
    }
}
