<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Withdraw;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function dashboard()
    {
        $courses = Course::where("instructor_id", auth()->user()->id)->get();

        return view("instructor.dashboard", ["courses" => $courses]);
    }

    public function earning(Request $request)
    {
        return view("instructor.earning");
    }

    public function transaction(){
        $total["History"] = array();
        $tran = Transaction::orderBy('id', 'desc')->get()->toArray();
        foreach($tran as $value){
            $arr2 = [];
            $stat = $value['type'];
            if($stat=="EARNING"){
                $ss = DB::select("select * from orders inner join transactions on orders.id = transactions.ref_id inner join courses on orders.course_id = courses.id inner join users on orders.purchase_by = users.id where courses.instructor_id = ? and transactions.ref_id = ?", [auth()->user()->id, $value['ref_id']]);
                 $resultsArray = json_decode(json_encode($ss), true);
                 
                 if(sizeof($resultsArray)===1){
                   $arr2["Date"]  = date("d-m-Y", strtotime($value['created_at']));
                   $arr2["Type"] = "Purchased";
                   $arr2["Amount"] = $resultsArray[0]['amount'];
                   $arr2["Name"] = $resultsArray[0]["title"];
                   $arr2["Desc"] = $resultsArray[0]["name"].", has purchased the cource: ".$resultsArray[0]["title"].", with order ID : ".$resultsArray[0]["order_id"];
                   $arr2["referrer"] = $resultsArray[0]["order_id"];
                   $arr2["status"] = $resultsArray[0]["payment_status"];
                   array_push($total["History"],$arr2);
                 }
                 
            }else{
                $ss = DB::select("SELECT * FROM transactions AS t1 INNER JOIN withdrawals AS t2 ON t1.ref_id = t2.id INNER JOIN users AS t3 ON t2.withdrawal_by = t3.id WHERE t3.id = ? and t1.ref_id = ?", [auth()->user()->id,$value['ref_id']]);
                $resultsArray = json_decode(json_encode($ss), true);  
                if(sizeof($resultsArray)===1){
                    $arr2["Date"]  = date("d-m-Y", strtotime($value['created_at']));
                    $arr2["Type"] = "Withdrawn";
                    $arr2["Amount"] = $resultsArray[0]['amount'];
                    $arr2["Name"] = "NA";
                    $arr2["Desc"] = "You have requested for withdraw the amount : ".$resultsArray[0]['amount'];
                    $arr2["referrer"] = $resultsArray[0]["reference"];
                    $arr2["status"] = $resultsArray[0]["withdrawal_status"];
                    array_push($total["History"],$arr2);
                }

            }
            
        }
        $totalinc = 0.00;
         $mm = DB::select("select * from courses where instructor_id =?", [auth()->user()->id]);
            $courcelist = json_decode(json_encode($mm), true);
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
              
          
        
        return view("instructor.earning",["histories" => $total,"Balance"=>$totalinc]);

    }

    public function paymentmethodadd(Request $request){
       if($request->apf_type=="bank account"){
          $data = [
            "Benificiary_Name" => $request->apf_ben_name,
            "Bank_Name" => $request->apf_bank_name,
            "Bank_Account" => $request->apf_account_no,
            "Ifsc_Code" => $request->apf_ifsc_code,
            
        ];
        
        $totalbank = json_encode($data);

       $paymode = new PaymentMethod();
       $paymode->instructor_id = auth()->user()->id;
       $paymode->type = "Bank";
       $paymode->details = $totalbank;

       $paymode->save();

       }else{
        $data = [
            "Paypal_Url" =>$request->apf_paypal_url,
            
        ];
        
        $payurl = json_encode($data);

       $paymode = new PaymentMethod();
       $paymode->instructor_id = auth()->user()->id;
       $paymode->type = "PAYPAL";
       $paymode->details = $payurl;

       $paymode->save();
       }
       $total["History"] = array();
       $tran = Transaction::orderBy('id', 'desc')->get()->toArray();
       foreach($tran as $value){
           $arr2 = [];
           $stat = $value['type'];
           if($stat=="EARNING"){
               $ss = DB::select("select * from orders inner join transactions on orders.id = transactions.ref_id inner join courses on orders.course_id = courses.id inner join users on orders.purchase_by = users.id where courses.instructor_id = ? and transactions.ref_id = ?", [auth()->user()->id, $value['ref_id']]);
                $resultsArray = json_decode(json_encode($ss), true);
                
                if(sizeof($resultsArray)===1){
                  $arr2["Date"]  = date("d-m-Y", strtotime($value['created_at']));
                  $arr2["Type"] = "Purchased";
                  $arr2["Amount"] = $resultsArray[0]['amount'];
                  $arr2["Name"] = $resultsArray[0]["title"];
                  $arr2["Desc"] = $resultsArray[0]["name"].", has purchased the cource: ".$resultsArray[0]["title"].", with order ID : ".$resultsArray[0]["order_id"];
                  $arr2["referrer"] = $resultsArray[0]["order_id"];
                  $arr2["status"] = $resultsArray[0]["payment_status"];
                  array_push($total["History"],$arr2);
                }
                
           }else{
               $ss = DB::select("SELECT * FROM transactions AS t1 INNER JOIN withdrawals AS t2 ON t1.ref_id = t2.id INNER JOIN users AS t3 ON t2.withdrawal_by = t3.id WHERE t3.id = ? and t1.ref_id = ?", [auth()->user()->id,$value['ref_id']]);
               $resultsArray = json_decode(json_encode($ss), true);  
               if(sizeof($resultsArray)===1){
                   $arr2["Date"]  = date("d-m-Y", strtotime($value['created_at']));
                   $arr2["Type"] = "Withdrawn";
                   $arr2["Amount"] = $resultsArray[0]['amount'];
                   $arr2["Name"] = "NA";
                   $arr2["Desc"] = "You have requested for withdraw the amount : ".$resultsArray[0]['amount'];
                   $arr2["referrer"] = $resultsArray[0]["reference"];
                   $arr2["status"] = $resultsArray[0]["withdrawal_status"];
                   array_push($total["History"],$arr2);
               }

           }
           
       }
       return view("instructor.earning",["histories" => $total,"Message"=>"Payment Method Added Successfully."]);
    }

    public function withdraw(Request $request){
        $totalinc = 0.00;
         $mm = DB::select("select * from courses where instructor_id =?", [auth()->user()->id]);
            $courcelist = json_decode(json_encode($mm), true);
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
            if($totalinc>=$request->rf_amount){
                $withd = new Withdraw();
                $withd->withdrawal_by = auth()->user()->id;
                $withd->amount = $request->rf_amount;
         
                $withd->save();
                $last = $withd->id;
         
                $tran = new Transaction();
                $tran->type = "WITHDRAWL";
                $tran->ref_id = $last;
         
                $tran->save();
                return redirect()->route("instructor.transaction");
            }else{
                return redirect()->route("instructor.transaction");
            }
       
       
       

    }
    

  
}
