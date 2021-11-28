<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingProductionLine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ProductionLineController extends Controller
{
    use Viewable;

    private $viewable = 'AccountingSystem.production_lines.';


    public function index()
    {
        $lines = AccountingProductionLine::with('company')->get();
        return $this->toIndex(compact('lines'));
    }


    public function create()
    {
        $companies = AccountingCompany::pluck('name', 'id')->toArray();
        return $this->toCreate(compact('companies'));
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:191|unique:accounting_production_lines,name',
            'accounting_company_id' => 'required|numeric|exists:accounting_companies,id',
        ];
        $this->validate($request, $rules);
        AccountingProductionLine::create($request->all());
        alert()->success('تم اضافة  الخط بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.productionLines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $line = AccountingProductionLine::findOrFail($id);
        $companies = AccountingCompany::pluck('name', 'id')->toArray();
        return $this->toEdit(compact('line','companies'));
    }


    public function update(Request $request, $id)
    {
        $line = AccountingProductionLine::findOrFail($id);
        $rules = [
            'name' => 'required|max:191|unique:accounting_production_lines,name,' . $line->id,
            'accounting_company_id' => 'required|numeric|exists:accounting_companies,id',
        ];
        $this->validate($request, $rules);
        $line->update($request->all());
        alert()->success('تم تعديل  الخط  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.productionLines.index');
    }


    public function destroy($id)
    {
        $line = AccountingProductionLine::findOrFail($id);
        $line->delete();
        alert()->success('تم حذف  الخط بنجاح !')->autoclose(5000);
        return back();
    }
}
