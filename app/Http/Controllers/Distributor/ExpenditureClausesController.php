<?php

namespace App\Http\Controllers\Distributor;

use App\Models\ExpenditureClause;
use App\Models\Store;
use App\Models\StoreCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ExpenditureClausesController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.expenditureClauses.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditureClauses = ExpenditureClause::all();
        return $this->toIndex(compact('expenditureClauses'));
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
            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        ExpenditureClause::create($request->all());
        toast('تم الإضافة بنجاح','success','top-right');
        return redirect()->route('distributor.expenditureClauses.index');
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
        $expenditureClause =ExpenditureClause::findOrFail($id);
        return $this->toEdit(compact('expenditureClause'));


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
       $expenditureClause = ExpenditureClause::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $expenditureClause->update($request->all());
        toast('تم التعديل بنجاح','success','top-right');
        return redirect()->route('distributor.expenditureClauses.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenditureClause  = ExpenditureClause::find($id);

        $expenditureClause->delete();
            toast('تم الحذف بنجاح', 'success','top-right');
            return back();


    }
}
