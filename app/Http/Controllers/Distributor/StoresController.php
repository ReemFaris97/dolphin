<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\Store;
use App\Models\StoreCategory;
use App\User;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $stores = Store::with('distributor', 'category')->get()->reverse();
        return $this->toIndex(compact('stores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $store_categories = StoreCategory::pluck('name', 'id');

        $distributor = User::query()->available()->distributor()->pluck('name', 'id');

        return $this->toCreate(compact('store_categories', 'distributor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:191',
            'store_category_id' => "required|numeric|exists:store_categories,id",
            'distributor_id' => 'required|integer|exists:users,id',
            'note' => 'nullable|string'
        ];
        $this->validate($request, $rules);
        Store::create($request->all());
        toast('تم الإضافة بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        return $this->toShow(['store' => Store::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $store_categories = StoreCategory::pluck('name', 'id');
        $distributor = User::query()->available()->distributor()->pluck('name', 'id');

        return $this->toEdit(compact('store', 'store_categories', 'distributor'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:191',
            'store_category_id' => "required|numeric|exists:store_categories,id",
            'distributor_id' => 'required|integer|exists:users,id',
            'note' => 'nullable|string'
        ];
        $this->validate($request, $rules);
        $store->update($request->all());
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.stores.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        if ($store->products->count() > 0) {
            toast('لا يمكن حذف مستودع به اصناف', 'error', 'top-right');
            return back();
        } else {
            $store->delete();
            toast('تم الحذف بنجاح', 'success', 'top-right');
            return back();

        }
    }


    public function changeStatus($id)
    {
        $item = Store::find($id);
//        dd($item);
        if ($item->is_active == 1) {
            $item->update(['is_active' => 0]);
            toast('تم إلغاء التفعيل بنجاح', 'success', 'top-right');
            return redirect()->route('distributor.stores.index');
        } else {
            $item->update(['is_active' => 1]);
            toast('تم  التفعيل بنجاح', 'success', 'top-right');
            return redirect()->route('distributor.stores.index');
        }
    }

    public function addProduct($store_id)
    {
        return view('distributor.stores.addProducts',
            [
                'users' => User::query()->distributor()->pluck('name', 'id'),
                'store' => Store::query()->find($store_id),
                'products' => Product::query()->pluck('name', 'id'),
            ]);

    }
}
