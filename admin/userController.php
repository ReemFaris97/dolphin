<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\City;
use App\Group;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Activity;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index')->with('users',User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $inputs=$request->all();
        $this->validate($request,[
            'name'=>'required|string|',
            'email'=>'required|nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',


        ]);


        if ($request->has('password'))
            $inputs['password'] = bcrypt($request->password);

       $user= User::create($inputs);

        alert()->success('تم اضافة المستخدم بنجاح !')->autoclose(5000);
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        return view('admin.users.show_activity',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user=User::find($id);

        return view('admin.users.edit',compact('user'));
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
        $user=User::find($id);
      //  dd($request->all());
        $this->validate($request,[
            'name'=>'required|string|',
            'email'=>'required|string|email|max:255|unique:users,email,'.$user->id,




        ]);

        $inputs=$request->except('password');




        if ($request->has('password'))
            $inputs['password'] = bcrypt($request->password);

        $user->update($inputs);


        alert()->success('تم تعديل المستخدم بنجاح !')->autoclose(5000);
        return redirect('dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if($user->email=='admin@admin.com'){
            alert()->error('لايمكن حذف الادمن  ');
            return back();
        }
        if ($user){
            $user->delete();
            alert()->success('تم حذف الادمن بنجاح');
            return back();
        }
        alert()->error('الادمن الذى تحاول حذفه غير موجود');
        return back();
    }

}
