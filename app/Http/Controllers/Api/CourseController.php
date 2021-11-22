<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        return ['courses' => CourseResource::collection($courses)];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Course::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'lecturer' => $request->lecturer,
            'number_sks' => $request->number_sks,
            'description' => $request->description
        ]);

        return ['message' => 'Data has been saved'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $code = Str::upper($id);
        $course = Course::all()->where('course_code', $code);

        return ['courses' => CourseResource::collection($course)];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $code = Str::upper($id);
        $course = Course::findOrFail($code);
        $course->update([
            'course_name' => $request->course_name,
            'lecturer' => $request->lecturer,
            'number_sks' => $request->number_sks,
            'description' => $request->description
        ]);

        return ['message' => 'Data has been updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return ['message' => 'Data has been deleted'];
    }
}
