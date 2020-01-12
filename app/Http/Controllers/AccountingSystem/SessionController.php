<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSession;
use App\Traits\Viewable;
use App\User;
use Request as GlobalRequest;

class SessionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $benods=AccountingBenod::all();
        return $this->toIndex(compact('benods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $inputs= $request->all();
        $rules = [


        ];
        $this->validate($request,$rules);
       $session= AccountingSession::create($inputs);
    $user=User::where('email',$inputs['email'])->first();

    $session->update([
        'user_id'=>$user->id,
    ]);

    if ($request->password != null && !\Hash::check($request->password, $user->password)) {
        return back()->withInput()->withErrors(['password' => 'كلمه المرور  غير صحيحه']);
    }


        alert()->success('تم فتح الجلسة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.sells_points.sells_point',compact('session'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }


    public function getbenods($type)
    {


    }
}
