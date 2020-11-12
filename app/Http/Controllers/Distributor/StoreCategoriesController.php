<?php

namespace App\Http\Controllers\Distributor;

use App\Models\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreCategoriesController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.storeCategories.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = StoreCategory::all()->reverse();
        return $this->toIndex(compact('categories'));
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
//        $rules = ;
        $this->validate($request,['name'=>'required|string|max:191']);
        StoreCategory::create($request->all());
        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.store_categories.index');

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
        $category = StoreCategory::findOrFail($id);
        return $this->toEdit(compact('category'));
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
        $category = StoreCategory::find($id);
        $this->validate($request,['name'=>'required|string|max:191']);
        $category->update($request->all());
        toast('تم التعديل بنجاح','success','top-right');
        return redirect()->route('distributor.store_categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = StoreCategory::find($id);
        if($category->stores->count() > 0){
            toast('لا يمكن حذف نوع لديه مستوعات', 'error', 'top-right');
            return back();
        }else{
            $category->delete();
            toast('تم الحذف بنجاح', 'success', 'top-right');
            return back();
        }

    }
}
