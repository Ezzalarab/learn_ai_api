<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function coursesList()
    {
        try {
            $courses = Course::select('name', 'thumbnail', 'lessons_count', 'price', 'id')->get();

            return response()->json([
                "status" => true,
                "message" => "Courses List Fetched Successfully",
                "data" => $courses,
            ], 200,);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
                "data" => $th->getTrace(),
            ], 500);
        }
    }


    public function courseDetails(Request $request)
    {
        try {
            $id = $request->courseId;
            $courses = Course::where('id', '=', $id)->select(
                'id',
                'name',
                'user_token',
                'description',
                'thumbnail',
                'lessons_count',
                'price',
                'resourses_count',
                'video_length',
            )->first();

            return response()->json([
                "status" => true,
                "message" => "Course Fetched Successfully",
                "data" => $courses,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
                "data" => $th->getTrace(),
            ], 500);
        }
    }
}
