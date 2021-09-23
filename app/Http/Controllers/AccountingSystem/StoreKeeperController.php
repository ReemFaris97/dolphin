<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Requests\UserRequest;
use App\Models\AccountingSystem\AccountingInventory;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingStoreKeeper;
use App\Models\Permission;
use App\Sell;
use App\Store;
use App\StoreKeeper;
use App\Traits\Viewable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class StoreKeeperController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.storekeepers.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        if (!auth()->user()->hasPermissionTo('view_workers')) {
//            return abort(401);
//        }
        $storeKeepers = User::where('is_storekeeper', 1)->get();


        return $this->toIndex(compact('storeKeepers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = AccountingStore::pluck('ar_name', 'id')->toArray();

        return $this->toCreate(compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|string|max:191',
            'email'=>'required|string|unique:users,email',
            'phone'=>['required','unique:users,phone']

        ];

        $messsage = [
            'name.required'=>"الإسم مطلوب",
            'email.required'=>"البريد الإلكتروني مسجل من قبل",
            'email.unique'=>"الإيميل مسجل من قبل",


        ];

        $this->validate($request, $rules, $messsage);


        $requests = $request->all();
        //حسبى الله ونعم والوكيل
        $storeKeeper = User::create($requests);
        $storeKeeper->update([
            'is_storekeeper'=>1,
            'is_admin'=>1,

        ]);

        alert()->success('تم اضافة الامين بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.storeKeepers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $storekeeper= User::findOrFail($id);
        $inventories=AccountingInventory::where('user_id', $id)->get();
        return $this->toShow(compact('storekeeper', 'inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storeKeeper=User::findOrFail($id);
        $stores = AccountingStore::pluck('ar_name', 'id')->toArray();

        return $this->toEdit(compact('storeKeeper', 'stores'));
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
        $storeKeeper = User::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
            'email'=>'required|string|unique:users,email,'.$storeKeeper->id,
        ];
        $this->validate($request, $rules);
        $inputs=$request->except('password');
        if ($request->password != null) {
            $storeKeeper->update(['password'=>$request->password,]);
        }

        $storeKeeper->update(($inputs));


        alert()->success('تم تعديل   بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.storeKeepers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storeKeeper=User::find($id);

        $storeKeeper->delete();
        alert()->success('تم حذف  الامين بنجاح');
        return back();
    }
}
