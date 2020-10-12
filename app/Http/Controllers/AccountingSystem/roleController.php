<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Activity;
use App\City;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =Role::orderBy('id','DESC')->get();

        return view('AccountingSystem.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permission = Permission::where('ar_name','-')->get();
       
        return view('AccountingSystem.roles.create',compact('permission'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));



        alert()->success('The role was added successfully !!')->autoclose(5000);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::where('ar_name','-')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();



        foreach ($role->users as $user)
        {
            DB::table('model_has_permissions')->where('model_id',$user->id)->delete();

            $user->assignRole(Role::find($id));
            $user->syncPermissions(Role::find($id)->permissions()->pluck('id'));

        }
        return view('AccountingSystem.roles.edit',compact('role','permission','rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));

        alert()->success('تم  تعديل  الصلاحية بنجاح')->autoclose(5000);
        return redirect('accounting/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { //dd($id);
        $role=Role::find($id);

        $role->delete();
            alert()->success(' تم حذف الصلاحية بنجاح');
            return back();
    }
}
