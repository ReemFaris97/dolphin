<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
        $roles = Role::all();
        $titles = AccountingJobTitle::where('active', '1')->pluck('name', 'id')->toArray();
        return $this->toCreate(compact('roles', 'titles'));
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

            'name' => 'required|string|max:191',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|max:191',
            'image' => 'nullable|sometimes|image',
            'role_id' => 'required|numeric|exists:roles,id',

        ];
        $messsage = [
            'role_id.required' => "تحديد الدور او المهام مطلول",
        ];
        $this->validate($request, $rules, $messsage);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
               $requests['is_admin']=1;
        //        dd($requests);

        if ($requests['role'] == 'is_accountant') {
            $requests['is_accountant'] = 1;
        } elseif ($requests['role'] == 'is_saler') {
            $requests['is_saler'] = 1;
        } elseif ($requests['role'] == 'is_admin') {
            $requests['is_admin'] = 1;
        }
        $user = User::create($requests);
        $user->assignRole(Role::find($request->input('role_id')));

        //dd(Role::find($request->input('role_id'))->permissions()->pluck('id'));
        $user->syncPermissions(Role::find($request->input('role_id'))->permissions()->pluck('id'));

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
        $user = User::findOrFail($id);
        $userRole = $user->roles->pluck('name', 'id')->all();
        $roles = Role::all();
        $titles = AccountingJobTitle::where('active', '1')->pluck('name', 'id')->toArray();

        return $this->toEdit(compact('user', 'userRole', 'roles', 'titles'));
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
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'email' => 'required|string|unique:users,email,' . $user->id,
            'image' => 'nullable|sometimes|image'
        ];
        $this->validate($request, $rules);
        $requests = $request->except('image', 'password');
        //        dd($requests);
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }

        if ($request->password != null) {
            $user->update(['password' => bcrypt($request->password),]);
            unset($requests['password']);;
        }


        if ($requests['role'] == 'is_accountant') {
            $requests['is_accountant'] = 1;
        }
         if ($requests['role'] == 'is_saler') {
            $requests['is_saler'] = 1;
        }
        if ($requests['role'] == 'is_admin') {
            $requests['is_admin'] = 1;
        }
        $user->update($requests);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        DB::table('model_has_permissions')->where('model_id', $id)->delete();
        $user->assignRole(Role::find($request->input('role_id')));
        $user->syncPermissions(Role::find($request->input('role_id'))->permissions()->pluck('id'));

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
        $user = User::findOrFail($id);
        $user->delete();
        alert()->success('تم حذف  العضو بنجاح !')->autoclose(5000);
        return back();
    }

    public  function  user_permissions($id)
    {
        $user = User::findOrFail($id);
        $companies = AccountingCompany::all();
        $branches = AccountingBranch::all();
        $stores = AccountingStore::all();
        $userpermisionscompany = AccountingUserPermission::where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->where('user_id', $id)->pluck('model_id')->all();
        $userpermisionsbranch = AccountingUserPermission::where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->where('user_id', $id)->pluck('model_id')->all();
        $userpermisionsstore = AccountingUserPermission::where('model_type', 'App\Models\AccountingSystem\AccountingStore')->where('user_id', $id)->pluck('model_id')->all();

        return view('AccountingSystem.users.permissions', compact('user', 'companies', 'branches', 'stores', 'userpermisionscompany', 'userpermisionsbranch', 'userpermisionsstore'));
    }


    public  function getBranchesPermission($id)
    {
        $branches = AccountingBranch::where('company_id', $id)->get();
        return response()->json([
            'status' => true,
            'branch' => view('AccountingSystem.users.branches')->with('branches', $branches)->render()
        ]);
    }


    public  function getStoresPermission($id)
    {
        $stores = AccountingStore::where('model_id', $id)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->get();
        return response()->json([
            'status' => true,
            'store' => view('AccountingSystem.users.stores')->with('stores', $stores)->render()
        ]);
    }

    public  function getStoresCampanyPermission($id)
    {
        $stores = AccountingStore::where('model_id', $id)->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->get();
        return response()->json([
            'status' => true,
            'store' => view('AccountingSystem.users.stores')->with('stores', $stores)->render()
        ]);
    }

    public  function  user_permissions_update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->permissions()->delete();
        $inputs = $request->all();
        foreach ($inputs['companies'] as $company) {
            AccountingUserPermission::create([
                'user_id' => $id,
                'model_type' => 'App\Models\AccountingSystem\AccountingCompany',
                'model_id' => $company
            ]);
        }
        foreach ($inputs['branches'] as $branch) {
            AccountingUserPermission::create([
                'user_id' => $id,
                'model_type' => 'App\Models\AccountingSystem\AccountingBranch',
                'model_id' => $branch
            ]);
        }
        foreach ($inputs['stores'] as $store) {
            AccountingUserPermission::create([
                'user_id' => $id,
                'model_type' => 'App\Models\AccountingSystem\AccountingStore',
                'model_id' => $store
            ]);
        }
        alert()->success('تم تحديث صلاحيات  العضو بنجاح !')->autoclose(5000);
        return back();
    }
    public  function  permissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions()->get();
        return response()->json([
            'status' => true,
            'permission' => view('AccountingSystem.users.permission')->with('permissions', $permissions)->render()
        ]);
    }
}
