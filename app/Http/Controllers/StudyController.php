<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Lesson;
use App\Models\Study;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function learn(Request $request)
    {
        $has_access = Enroll::where(["student_id" => auth()->user()->id, "course_id" => $request->course_id])->first();

        if (!$has_access) {
            echo "No Access";
            return;
        }

        $menus = $this->get_menus();

        $course = Course::find($request->course_id);
        $chapters = [];

        $course_chapters = Chapter::where("course_id", $course->id)->get();
        foreach ($course_chapters as $chapter) {
            $chapter->lessons = Lesson::where("chapter_id", $chapter->id)->get();
            $chapters[] = $chapter;
        }

        $course->chapters = $chapters;

        if($request->has("lesson_id")) 
        {
            $lesson = Lesson::find($request->lesson_id);
        }
        else 
        {
            $chapter = Chapter::where("course_id", $request->course_id)->first();
            $lesson = Lesson::where("chapter_id", $chapter->id)->first();
        }

        return view("frontend.study", ["course" => $course, "lesson" => $lesson, "menus" => $menus]);
    }

    public function lesson_mark_as_complete(Request $request)
    {

    }

    public function lesson_mark_as_incomplete(Request $request)
    {
        
    }

    public function check_access(Request $request) {

    } 

    public function get_menus()
    {
        $menu['category'] = array();
        $all = Category::where('parent_id', 0)->get()->toArray();
        foreach ($all as $value) {
            $arr1['subcat'] = array();
            $arr1["id"] = $value['id'];
            $arr1["title"] = $value['name'];
            $arr1["desc"] = $value['description'];
            $arr1["iamge"] = $value['image'];
            $bll = Category::where('parent_id', $value['id'])->get()->toArray();
            foreach ($bll as $vell) {
                $arr2 = [];
                $arr2["sub_id"] = $vell['id'];
                $arr2["sub_title"] = $vell['name'];
                $arr2["sub_desc"] = $vell['description'];
                $arr2["sub_image"] = $vell["image"];
                array_push($arr1['subcat'], $arr2);
            }
            array_push($menu['category'], $arr1);
        }
        return $menu;
    }
}
