<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Support\Facades\DB;

class Coursewiseearnings extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = "select A.title,A.enrolled, case when A.enrolled*courses.sale_price is null then '0.00' else A.enrolled*courses.sale_price end as income,courses.thumbnail,courses.language,courses.level from (select *,(select count(*) from enrolls where course_id = courses.id) as enrolled from courses where instructor_id = ?)A inner join courses on A.id = courses.id";

         $results = DB::select($query, [auth()->user()->id]);
         return view('instructor.coursewiseearn', ['support' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
