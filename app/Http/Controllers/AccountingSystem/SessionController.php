<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSession;
use App\Traits\Viewable;
use App\User;
use Carbon\Carbon;
use Cookie;
use Request as GlobalRequest;
use Response;
use Session;

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
        $device=AccountingDevice::find($inputs['device_id']);
        $device->update([
            'available'=>'0'
        ]);

        alert()->success('تم فتح الجلسة بنجاح !')->autoclose(5000);

        $session_id= $session->id;
        Cookie::queue('session',$session->id);



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

        $sessions=AccountingSession::where('status','closed')->get();

        return view("AccountingSystem.sessions.index_closed_session",compact('sessions'));

    }

    public function confirm(Request $request){

       $session=AccountingSession::find($request['session_id']);
       $session->update([
           'status'=>'confirmed',
           'custody'=>$request['custody']
       ]);
        $safe=AccountingSafe::find($request['safe_id']);
        $safe->update([
            'amount'=>$safe->amount+$request['custody']
        ]);
        alert()->success('تم تاكيداغلاق الجلسه  من  قبل  المحاسب بنجاح !')->autoclose(5000);

    }

    public function close($id){

        $session=AccountingSession::find($id);
        $session->update([
            'status'=>'closed',
        ]);


        alert()->success('تم اغلاق الجلسه  من  قبل  الكاشير بنجاح !')->autoclose(5000);
        return back();
    }



}
