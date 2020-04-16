<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingCompany;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class UserController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.users.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->reverse();
        return $this->toIndex(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return $this->toCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|max:191',
            'image'=>'nullable|sometimes|image',
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
//        $requests['is_admin']=1;
//        dd($requests);

        if ($requests['role']=='is_accountant')
        {
            $requests['is_accountant']=1;
        }elseif($requests['role']=='is_saler'){
            $requests['is_saler']=1;
        }elseif($requests['role']=='is_admin'){
            $requests['is_admin']=1;
        }
        $user=User::create($requests);

        alert()->success('تم اضافة المستخدم بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =User::findOrFail($id);

        return $this->toEdit(compact('user'));


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
        $user =User::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone,'.$user->id,
            'email'=>'required|string|unique:users,email,'.$user->id,
            'image'=>'nullable|sometimes|image'
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image','password');
//        dd($requests);
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }

        if($request->password != null) {$user->update(['password'=>bcrypt($request->password),]);}


        if ($requests['role']=='is_accountant')
        {
            $requests['is_accountant']=1;
        }elseif($requests['role']=='is_saler'){
            $requests['is_saler']=1;
        }elseif($requests['role']=='is_admin'){
            $requests['is_admin']=1;
        }
        $user->update(array_except($requests,['password']));
        alert()->success('تم تعديل  العضو بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.users.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::findOrFail($id);
        $user->delete();
        alert()->success('تم حذف  العضو بنجاح !')->autoclose(5000);
            return back();


    }
}
