<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Bank;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class SupplierController extends Controller
{
    use Viewable;
    private $viewable = 'suppliers.suppliers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = User::where('is_supplier',1)->where('parent_user_id','!=',Null)->get()->reverse();
        return $this->toIndex(compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $banks=Bank::pluck('name','id')->toArray();
        return $this->toCreate(compact('banks'));
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
        $requests['is_supplier'] = 1;
        $user = User::create($requests);


        alert()->success('تم الاضافة   بنجاح !')->autoclose(5000);
        return redirect()->route('supplier.suppliers.index');
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
        $banks=Bank::pluck('name','id')->toArray();
        return $this->toEdit(compact('user','banks'));
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
        alert()->success('تم التعديل   بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.suppliers.index');
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
        alert()->success('تم الحذف   بنجاح !')->autoclose(5000);

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
        alert()->success('تم التعديل   بنجاح !')->autoclose(5000);
        return back();
    }
}
