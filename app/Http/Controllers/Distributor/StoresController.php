<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Store;
use App\User;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoresController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.stores.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all()->reverse();
        return $this->toIndex(compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store_categories = StoreCategory::pluck('name','id');
        $distrbiutors = User::where('is_distributor',1)->pluck('name','id');
        return $this->toCreate(compact('store_categories','distrbiutors'));
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
            'store_category_id'=>"required|numeric|exists:store_categories,id",
                        'distributor_id'=>"nullable|numeric|exists:users,id"
        ];
        $this->validate($request,$rules);
        Store::create($request->all());
        toast('تم الإضافة بنجاح','success','top-right');
        return redirect()->route('distributor.stores.index');
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
        $store =Store::findOrFail($id);
        $store_categories = StoreCategory::pluck('name','id');
                $distrbiutors = User::where('is_distributor',1)->pluck('name','id');
        return $this->toEdit(compact('store','store_categories','distrbiutors'));


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
       $store = Store::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',
            'store_category_id'=>"required|numeric|exists:store_categories,id",
            'distributor_id'=>"nullable|numeric|exists:users,id"
        ];
        $this->validate($request,$rules);
        $store->update($request->all());
        toast('تم التعديل بنجاح','success','top-right');
        return redirect()->route('distributor.stores.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store  = Store::find($id);
        if($store->products->count() > 0){
            toast('لا يمكن حذف مخزن به منتجات', 'error','top-right');
            return back();
        }else{
            $store->delete();
            toast('تم الحذف بنجاح', 'success','top-right');
            return back();

        }
    }
}
