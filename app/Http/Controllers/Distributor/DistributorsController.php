<?php

namespace App\Http\Controllers\Distributor;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class DistributorsController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.distributors.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = User::where('is_distributor',1)->get()->reverse();
        return $this->toIndex(compact('distributors'));
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
            'password'=>'required|string|confirmed|max:191',
            'image'=>'nullable|sometimes|image',
        ];

        $this->validate($request,$rules);

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $requests['is_distributor'] = 1;
        $user = User::create($requests);

        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.distributors.index');
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
        $user = User::findOrFail($id);
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
//        $user->syncPermissions($request->permissions);
        $user->save();
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.distributors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        if (!auth()->user()->hasPermissionTo('delete_workers')) {
//            return abort(401);
//        }

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
}
