<?php

namespace App\Http\Controllers\AccountingSystem;


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
            'shift_id'=>'required|numeric|exists:accounting_branch_shifts,id',
            'device_id'=>'required|numeric|exists:accounting_devices,id',
            'email'=>'required',
            'password'=>'required|string|max:191',
        ];
        $messsage = [
            'shift_id.required'=>" اسم الوردية مطلوبة",
            'device_id.required'=>"اسم الجهاز مطلوب",
            'email.required'=>"ايميل  الكاشير مطلوب",
            'password.required'=>"كلمة المرور مطلوبة",
        ];
        $this->validate($request,$rules,$messsage);


      $user=User::where('email',$inputs['email'])->first();
      if (isset($user)) {
          $session = AccountingSession::create($inputs);
          $session->update([
              'user_id' => $user->id,
              'start_session' => Carbon::now(),
              'code' => Carbon::now() . "-" . optional($session->shift)->name . "-" . optional($session->device)->code

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


      }else{
          alert()->error('بيانات تسجيل دخول نقطه البيع خاطئة !')->autoclose(5000);
             return back();
      }



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


    public function destroy($id)
    {
        $ssession = AccountingSession::findOrFail($id);
        $ssession->delete();
        alert()->success('تم حذف  الجلسة بنجاح !')->autoclose(5000);
        return back();
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
       if(isset($session)){
        $session->update([
            'status'=>'confirmed',
            'custody'=>$request['custody']
        ]);
       }
        $safe=AccountingSafe::find($request['safe_id']);
        $safe->update([
            'amount'=>$safe->amount+$request['custody']
        ]);
        // alert()->success('تم تاكيداغلاق الجلسه  من  قبل  المحاسب بنجاح !')->autoclose(5000);
        return response()->json([
            'status'=>false,
        ]);
    }
    }

    public function close($id){

        $session=AccountingSession::find($id);
        $session->update([
            'status'=>'closed',
        ]);

        Cookie::queue(Cookie::forget('session'));
           $device=AccountingDevice::find($session->device_id);
           $device->update([
               'available'=>'1'
           ]);

        alert()->success('تم اغلاق الجلسه  من  قبل  الكاشير بنجاح !')->autoclose(5000);
        return back();
    }



}
