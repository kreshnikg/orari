<?php


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Semester;

class ScheduleController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();
        return view('schedules/admin/index',[
            "semesters" => $semesters
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
