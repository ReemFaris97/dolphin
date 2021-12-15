<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProduction;
use App\Models\AccountingSystem\AccountingProductionLine;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use App\Models\AccountingSystem\AccountingUserPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    use Viewable;

    private $viewable = 'AccountingSystem.productions.';


    public function index()
    {
        $productions = AccountingProduction::with(['company', 'production_line'])->get();
        return $this->toIndex(compact('productions'));
    }


    public function create()
    {
        $userPermissionsCompany = AccountingUserPermission::where('model_type', AccountingCompany::class)->where('user_id', auth()->user()->id)
            ->pluck('model_id')->all();

      //  $companies = AccountingCompany::pluck('name', 'id')->toArray();
        $companies = AccountingCompany::whereIn('id', $userPermissionsCompany)
            ->pluck('name','id')->toArray();
        $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
        // $products = AccountingProduct::whereType('creation')->get();
        $products = AccountingProduct::limit(100)->get();
        return $this->toCreate(compact('companies', 'units', 'products'));
    }


    public function store(Request $request)
    {
        $rules = [
            'company_id' => 'required|numeric|exists:accounting_companies,id',
            'production_line_id' => 'required|numeric|exists:accounting_production_lines,id',
            'products' => 'required|array',
        ];
        $inputs = $this->validate($request, $rules);
        DB::beginTransaction();
        $production = AccountingProduction::query()->create($inputs);
        $production->items()->createMany($request->products);
        DB::commit();
        alert()->success('تم اضافة  امر التصنيع بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.productions.index');
    }


    public function show($id)
    {
        $production = AccountingProduction::with('items')->findOrFail($id);
        return $this->toShow(compact('production'));
    }


    public function edit($id)
    {
        $userPermissionsCompany = AccountingUserPermission::where('model_type', AccountingCompany::class)->where('user_id', auth()->user()->id)
            ->pluck('model_id')->all();

        //  $companies = AccountingCompany::pluck('name', 'id')->toArray();
        $companies = AccountingCompany::whereIn('id', $userPermissionsCompany)
            ->pluck('name','id')->toArray();
        $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
        // $products = AccountingProduct::whereType('creation')->get();
        $products = AccountingProduct::limit(100)->get();
        $production = AccountingProduction::with('items')->findOrFail($id);
        return $this->toEdit(compact('units', 'companies','products','production'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'company_id' => 'required|numeric|exists:accounting_companies,id',
            'production_line_id' => 'required|numeric|exists:accounting_production_lines,id',
            'products' => 'required|array',
        ];
        $inputs = $this->validate($request, $rules);
        DB::beginTransaction();
        $production = AccountingProduction::findOrFail($id);
        $production->update($inputs);
        $production->items()->delete();
        $production->items()->createMany($request->products);
        DB::commit();
        alert()->success('تم تعديل  أمر التصنيع  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.productions.index');
    }


    public function destroy($id)
    {
        $production = AccountingProduction::findOrFail($id);
        $production->delete();
        alert()->success('تم الحذف بنجاح !')->autoclose(5000);
        return back();
    }



    public function updateStatus(Request $request,$id)
    {
        $production = AccountingProduction::findOrFail($id);
        $request->validate(['status'=>'required']);
        $production->update(['status'=>$request->status]);
        alert()->success('تم التعديل بنجاح !')->autoclose(5000);
        return back();
    }
}
