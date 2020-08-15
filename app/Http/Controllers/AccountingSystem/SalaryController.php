<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingUserSalary;
use App\Traits\Viewable;
use App\User;
use Doctrine\DBAL\Schema\Index;

class SalaryController extends Controller
{

    public function index(){
        $titles = AccountingJobTitle::pluck('name','id')->toArray();
        $users = User::pluck('name','id')->toArray();
        $salaries=AccountingUserSalary::all();
        $payments = AccountingPayment::where('active','1')->pluck('name','id')->toArray();

       return view('AccountingSystem.users.pay_salaries',compact('titles','users','salaries','payments'));
    }

    public function pay(Request $request){
        $bouns=$request['bouns'];
     if($request['type']=='one_employee'){
         $user=User::find($request['user_id']);
         AccountingUserSalary::create([
             'user_id'=>$request['user_id'],
             'salary'=>$user->salary,
             'bouns'=>$bouns[$request['user_id']],
             'total_salary'=>$user->salary+$bouns[$request['user_id']]
         ]);
     }elseif($request['type']=='job_title'){
         $users=User::where('title_id',$request['title_id'])->get();
         foreach($users as $user){
            AccountingUserSalary::create([
                'user_id'=>$user->id,
                'salary'=>$user->salary,
                'bouns'=>$bouns[$user->id],
                'total_salary'=>$user->salary+$bouns[$user->id],
            ]);
         }
     }elseif ($request['type']=='all'){
        $users=User::all();
        foreach($users as $user){
           AccountingUserSalary::create([
               'user_id'=>$user->id,
               'salary'=>$user->salary,
               'bouns'=>$bouns[$user->id],
               'total_salary'=>$user->salary+$bouns[$user->id],
           ]);
       }
     }






     
     alert()->success('تم دفع الراتب بنجاح !')->autoclose(5000);
     return redirect()->route('accounting.users.salaries_paid');
    }


    public function salaries(){
        $salaries=AccountingUserSalary::all();
        return view('AccountingSystem.users.salaries_paid',compact('salaries'));

    }


    public function  userSalary (Request $request)
    {
        $user_id=$request['user_id'];
        $user=User::find($user_id);
        $users=User::where('id',$request['user_id'])->get();
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.users.user_salary',compact('users'))->render()
        ]);
    }

    public function  titleSalary (Request $request)
    {
        $title_id=$request['title_id'];
        $users=User::where('title_id',$request['title_id'])->get();
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.users.user_salary',compact('users'))->render()
        ]);
    }
}
