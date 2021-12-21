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
use App\Models\AccountingSystem\AccountingProductRecipe;
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
       // $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
       //  $mainProducts = AccountingProduct::whereType('creation')->get();
//        $creationProducts = AccountingProductRecipe::pluck('product_id');
//        $products = AccountingProduct::whereIn('id',$creationProducts)->get();
        $creationProducts = AccountingProductRecipe::with('product')->get();

        return $this->toCreate(compact('companies','creationProducts'));
    }


    public function store(Request $request)
    {
       // dd($request->all());
        $rules = [
            'company_id' => 'required|numeric|exists:accounting_companies,id',
            'production_line_id' => 'required|numeric|exists:accounting_production_lines,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:accounting_products,id',
            'products.*.recipe_id' => 'required|integer|exists:accounting_product_recipes,id',
            'products.*.unit_id' => 'present',
            'products.*.quantity' => 'present|integer',
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
       // $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
        // $products = AccountingProduct::whereType('creation')->get();
       // $products = AccountingProduct::limit(100)->get();
         $production = AccountingProduction::with('items')->findOrFail($id);
        $creationProducts = AccountingProductRecipe::with('product')->get();
        return $this->toEdit(compact('production','companies','creationProducts'));
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


    public function getProductsCreationRecipesByAjax(Request $request)
    {
        //  $products = AccountingProduct::query()->creation()
        $creationProducts = AccountingProductRecipe::pluck('product_id');
      //  $products = AccountingProduct::whereIn('id',$creationProducts)->get();

        $products = AccountingProduct::query()
            ->whereIn('id',$creationProducts)
            ->when($request->search, function ($b) use ($request) {
                return $b->where(fn($q)=>$q
                    ->where('name', 'LIKE', '%'.$request->search . '%')
                    ->orWhere('en_name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search.'%')
                    ->orWhere('bar_code', 'like',"%$request->search%")
                );})->paginate(50);

        return response()->json([
            'status' => true,
            'has_more' => $products->hasMorePages(),
            'data' => $products,
        ]);
    }
}
