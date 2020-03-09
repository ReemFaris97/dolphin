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
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSession;
use App\Traits\Viewable;
use App\User;
use Carbon\Carbon;
use Request as GlobalRequest;



class SessionController extends Controller
{

    use Viewable;
private $viewable = 'AccountingSystem.sessions.';
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sessions=AccountingSession::all();
        return $this->toIndex(compact('sessions'));
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
            'start_session'=>Carbon::now(),
            'code'=>Carbon::now()."-".optional($session->shift)->name ."-".optional($session->device)->code

        ]);

        if ($request->password != null && !\Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'كلمه المرور  غير صحيحه']);
        }
        alert()->success('تم فتح الجلسة بنجاح !')->autoclose(5000);
        return \Redirect::route('accounting.sells_points.sells_point',['id' => $session->id])->with('session');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $session=AccountingSession::findOrFail($id);
        $sales=AccountingSale::where('session_id',$id)->get();

        return $this->toShow(compact('session','sales'));

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

    public function sessions_close(){

        $sessions=AccountingSession::all();

        return view("AccountingSystem.sessions.index_closed_session",compact('sessions'));

    }
}
