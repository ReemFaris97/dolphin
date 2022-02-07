<?php

namespace App\Http\Controllers\Distributor;

use App\Models\ExpenditureClause;
use App\Models\ExpenditureType;
use App\Models\Store;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ExpenditureTypesController extends Controller
{
    use Viewable;
    private $viewable = "distributor.expenditureTypes.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditureTypes = ExpenditureType::all();
        return $this->toIndex(compact("expenditureTypes"));
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
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        ExpenditureType::create($request->all());
        toast("تم الإضافة بنجاح", "success", "top-right");
        return redirect()->route("distributor.expenditureTypes.index");
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
        $expenditureType = ExpenditureType::findOrFail($id);
        return $this->toEdit(compact("expenditureType"));
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
        $expenditureType = ExpenditureType::findOrFail($id);

        $rules = [
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $expenditureType->update($request->all());
        toast("تم التعديل بنجاح", "success", "top-right");
        return redirect()->route("distributor.expenditureTypes.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenditureType = ExpenditureType::find($id);

        $expenditureType->delete();
        toast("تم الحذف بنجاح", "success", "top-right");
        return back();
    }

    public function changeStatus($id)
    {
        $item = ExpenditureType::find($id);
        if ($item->is_active == 1) {
            $item->update(["is_active" => 0]);
            toast("تم إلغاء التفعيل بنجاح", "success", "top-right");
            return redirect()->route("distributor.expenditureTypes.index");
        } else {
            $item->update(["is_active" => 1]);
            toast("تم  التفعيل بنجاح", "success", "top-right");
            return redirect()->route("distributor.expenditureTypes.index");
        }
    }
}
