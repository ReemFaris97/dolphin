<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Traits\Viewable;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    use Viewable;
    private $viewable = 'admin.users.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('view_workers')) {
            return abort(401);
        }
        $users = User::all();

        return $this->toIndex(compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('add_workers')) {
            return abort(401);
        }
        $permissions = Permission::all();
        return $this->toCreate(compact('permissions'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $rules = [
            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed|max:191',
            'image'=>'nullable|sometimes|image',
            "nationality" => "required|string",
            "job" => "required|string",
            "company_name" => "required|string",
            "is_admin" => "required|integer|in:0,1",
        ];

        $messsage = [
            'name.required'=>"الإسم مطلوب",
            'phone.required'=>"رقم الهاتف مطلوب",
            'phone.numeric'=>"الرقم يجب ان يكون ارقام",
            'phone.unique'=>"هذ الرقم مسجل من قبل",
            'email.required'=>"البريد الإلكتروني مسجل من قبل",
            'email.unique'=>"الإيميل مسجل من قبل",
            'password.required'=>"كلمة المرور مطلوبة",
            'password.confirmed'=>"تأكيد كلمة المرور غير مطابقة",
            'image.image'=>"الصورة مطلوبة",
            'nationality.required'=>"الجنسية مطلوبة",
            'job.required'=>"الوظيفة مطلوبة",
            'company_name.required'=>"إسم الشركة مطلوب",
        ];

        $this->validate($request,$rules,$messsage);


        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $user = User::create($requests);

        $user->syncPermissions(['33','34','35','36','37','38']);
        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo('edit_workers')) {
            return abort(401);
        }
        $permissions = Permission::all();
        $user = User::findOrFail($id);

        return $this->toEdit(compact('user', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone,'.$user->id,
            'email'=>'required|string|unique:users,email,'.$user->id,
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image','password');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        if ($request->password != null && !\Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->withErrors(['old_password' => 'كلمه المرور القديمه غير صحيحه']);
        }
        $user->fill($requests);
        $user->syncPermissions($request->permissions);
        $user->save();
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_workers')) {
            return abort(401);
        }
        $user = User::find($id);
        $user_Tasks = $user->tasks->filter(function ($user) {
            return Carbon::now()->lessThanOrEqualTo($user->from_time);
        });

        if ($user_Tasks->count() > 0) {
            toast('لا يمكن حذف موظف لديه مهام', 'error', 'top-right');
            return back();
        }
        User::find($id)->forceDelete();
        toast('تم الحذف', 'success', 'top-right');
        return back();
    }

    public function block($id)
    {
        $user = User::find($id);

        $blocked_at = $user->blocked_at;
        if ($blocked_at == null) {
            $user->fill(['blocked_at' => Carbon::now(env('TIME_ZONE','Africa/Cairo'))]);
        } else {
            $user->fill(['blocked_at' => null]);
        }
        $user->save();
        toast('تم التعديل', 'success', 'top-right');
        return back();
    }

    public function editProfile(){
        $user = auth()->user();
        return view('admin.profile.edit',compact('user'));

    }
    public function updateProfile(Request $request){
        $user = User::findOrFail(auth()->id());

        $rules = [
            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone,'.$user->id,
            'email'=>'required|string|unique:users,email,'.$user->id,
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image','password');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        if ($request->password != null && !\Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->withErrors(['old_password' => 'كلمه المرور القديمه غير صحيحه']);
        }
        $user->fill($requests);
        $user->syncPermissions($request->permissions);
        $user->save();
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->back();
    }

    public function TurnUserToDistributor($id){
        $user = User::find($id);

        $user->is_distributor = 1;
        $user->save();
        toast('تم التحويل بنجاح', 'success', 'top-right');
        return back();
    }

}
