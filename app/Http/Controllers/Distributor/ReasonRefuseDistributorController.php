<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorCar;
use App\Models\Reader;
use App\Models\ReasonRefuseDistributor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ReasonRefuseDistributorController extends Controller
{

    use Viewable;
    private  $viewable = 'distributor.refuse_reasons.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $refuses = ReasonRefuseDistributor::all();
       // dd($refuse);
        return $this->toIndex(compact('refuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        return $this->toCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        ReasonRefuseDistributor::create($requests);
        toast('تم إضافة سبب الرفض بنجاح','success','top-right');
        return redirect()->route('distributor.refuses.index');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $refuse = ReasonRefuseDistributor::findOrFail($id);

        return $this->toEdit(compact('refuse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $reader= ReasonRefuseDistributor::find($id);

        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $reader->update($requests);
        toast('تم تعديل  سبب الرفض بنجاح','success','top-right');
        return redirect()->route('distributor.refuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        ReasonRefuseDistributor::find($id)->delete();
        toast('تم حذف سبب الرفض بنجاح','success','top-right');
        return redirect()->route('distributor.refuses.index');
    }

    public function changeStatus($id)
    {
        $item=ReasonRefuseDistributor::find($id);
        if ($item->is_active == 1) {
            $item->update(['is_active'=>0]);
            toast('تم إلغاء التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.refuse.index');
        } else {
            $item->update(['is_active'=>1]);
            toast('تم  التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.refuses.index');
        }
    }
}
