<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   public function get_students(Request $request)
    {
        $students = Enroll::select("student_id")->get()->toArray(); 
        $users = User::whereIn("id", $students)->get();

        $records = [];
        foreach($users as $user) 
        {
            $user->enrolls =  Enroll::where("student_id", $user->id)->count();
            $records[] = $user;
        }
    }

    public function get_instructors()
    {
        $totalinc = 0.00;
        $total["track"] = array();
        $ss = DB::select("select distinct instructor_id as ins from courses");
        $inslist = json_decode(json_encode($ss), true);
        foreach($inslist as $value){
            $arr2 = [];
            $rtt = DB::select("select * from users where id =?", [$value['ins']]);
            $arr2['Name'] = $rtt[0]->name;
            $mm = DB::select("select * from courses where instructor_id =?", [$value['ins']]);
            $courcelist = json_decode(json_encode($mm), true);
            $count_course = sizeof($courcelist);
            $arr2["courcenum"] = $count_course;
            foreach($courcelist as $vel){
                $nn = DB::select("select * from orders where course_id =?", [$vel['id']]);
                $orderlist = json_decode(json_encode($nn), true); 
                $numberpurchase = sizeof($orderlist);
                if($numberpurchase==0){
                    $price = 0.00; 
                }else{
                    foreach($orderlist as $vold){
                        $price = $vold['amount'];
                      }
                }
                  
                $totalinc = $totalinc+$numberpurchase*$price;
            }
              $arr2["incometotal"] = $totalinc;
              array_push($total["track"],$arr2);
        }
        //dd($total);
        return view('admin.instructors',["briefearning" => $total]);
    }

    public function get_CourceBy_student($id){
        $ss = DB::select("select courses.*,users.name from enrolls inner join courses on courses.id = enrolls.course_id inner join users on users.id = enrolls.student_id where enrolls.student_id = ?", [$id]);
        $courcelist = json_decode(json_encode($ss), true);  

        return view('admin.students',["studentcource" => $courcelist]);
    }


   
}
