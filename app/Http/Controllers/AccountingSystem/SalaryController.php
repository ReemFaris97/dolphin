<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingUserSalary;
use App\Traits\Viewable;
use App\User;
use Doctrine\DBAL\Schema\Index;

class SalaryController extends Controller
{

    public function index(){
        $titles = AccountingJobTitle::pluck('name','id')->toArray();
        $users = User::pluck('name','id')->toArray();

       return view('AccountingSystem.users.pay_salaries',compact('titles','users'));
    }

    public function pay(Request $request){

     if($request['type']=='one_employee'){
         $user=User::find($request['user_id']);

         
         AccountingUserSalary::create([
             'user_id'=>$request['user_id'],
             'salary'=>$user->salary,
             'bouns'=>$request['bouns'],
             'total_salary'=>$user->salary+$request['bouns']
         ]);
     }elseif($request['type']=='job_title'){
         $users=User::where('title_id',$request['title_id'])->get();
         foreach($users as $user){
            AccountingUserSalary::create([
                'user_id'=>$user->id,
                'salary'=>$user->salary,
                'bouns'=>null,
                'total_salary'=>$user->salary,
            ]);
         }

     }elseif ($request['type']=='all'){
        $users=User::all();
        foreach($users as $user){
           AccountingUserSalary::create([
               'user_id'=>$user->id,
               'salary'=>$user->salary,
               'bouns'=>null,
               'total_salary'=>$user->salary,
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
}
