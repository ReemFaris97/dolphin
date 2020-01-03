<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Requests\UserRequest;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingStoreKeeper;
use App\Models\Permission;
use App\Sell;
use App\Store;
use App\StoreKeeper;
use App\Traits\Viewable;
use App\User;
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
        $storeKeepers = User::where('is_storekeeper',1)->get();

        return $this->toIndex(compact('storeKeepers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $stores = AccountingStore::pluck('ar_name','id')->toArray();

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
            'email'=>'required|string|unique:accounting_storekeepers,email',


        ];

        $messsage = [
            'name.required'=>"الإسم مطلوب",
            'email.required'=>"البريد الإلكتروني مسجل من قبل",
            'email.unique'=>"الإيميل مسجل من قبل",


        ];

        $this->validate($request,$rules,$messsage);


        $requests = $request->all();
       // dd($requests);

        $storeKeeper = User::create($requests);
        $storeKeeper->update([
            'is_storekeeper'=>1,
            'is_admin'=>1,
            'accounting_store_id'=>$requests['store_id']
        ]);

        alert()->success('تم التعديل الامين بنجاح !')->autoclose(5000);
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

        $storekeeper= AccountingStoreKeeper::findOrFail($id);
        return $this->toShow(compact('storekeeper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storeKeeper= AccountingStoreKeeper::findOrFail($id);
        $stores = AccountingStore::pluck('ar_name','id')->toArray();

        return $this->toEdit(compact('storeKeeper','stores'));

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
        $storeKeeper = AccountingStoreKeeper::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
            'email'=>'required|string|unique:accounting_storekeepers,email,'.$storeKeeper->id,
        ];
        $this->validate($request,$rules);
        $inputs=$request->all();
        if($request->password != null) {$storeKeeper->update(['password'=>bcrypt($request->password),]);}

        $storeKeeper->update(array_except($inputs,['password']));


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
        $storeKeeper=AccountingStoreKeeper::find($id);

        $storeKeeper->delete();
            alert()->success('تم حذف   بنجاح');
            return back();

    }



}
