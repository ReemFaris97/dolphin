<?php
declare(strict_types=1);

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use App\Models\AccountingSystem\AccountingProductRecipe;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingUserPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;

class ProductRecipeController extends Controller
{
    use Viewable;

    private $viewable = 'AccountingSystem.product-recipes.';


    public function index()
    {
        $products = AccountingProductRecipe::with(['product', 'unit'])->get();
        return $this->toIndex(compact('products'));
    }


    public function create()
    {
        // $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
        //  $mainProducts = AccountingProduct::whereType('creation')->get();
        // $mainProducts = AccountingProduct::limit(50)->pluck('name','id');
//        $products = AccountingProduct::limit(50)->get();

        return $this->toCreate();
    }


    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|numeric|exists:accounting_products,id',
            'unit_id' => 'present',
            'recipes' => 'required|array|min:1',
            'recipes.*.product_id' => 'required|integer|exists:accounting_products,id',
            'recipes.*.unit_id' => 'present',
            'recipes.*.quantity' => 'present|integer',
        ];

        $inputs = $this->validate($request, $rules);
        DB::beginTransaction();
        $productRecipe = AccountingProductRecipe::query()->create($inputs);
        $productRecipe->items()->createMany($request->recipes);
        DB::commit();
        alert()->success('تم اضافة مكونات الصنف بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.product-recipes.index');
    }


    public function show($id)
    {
        $product = AccountingProductRecipe::with('items')->findOrFail($id);
        return $this->toShow(compact('product'));
    }


    public function edit($id)
    {
        $userPermissionsCompany = AccountingUserPermission::where('model_type', AccountingCompany::class)->where('user_id', auth()->user()->id)
            ->pluck('model_id')->all();

        //  $companies = AccountingCompany::pluck('name', 'id')->toArray();
        $companies = AccountingCompany::whereIn('id', $userPermissionsCompany)
            ->pluck('name', 'id')->toArray();
        $units = AccountingProductMainUnit::pluck('main_unit', 'id')->toArray();
        // $products = AccountingProduct::whereType('creation')->get();
        $products = AccountingProduct::limit(100)->get();
        $product = AccountingProductRecipe::with(['items'=>fn($q)=>$q->with('product')])->findOrFail($id);
        return $this->toEdit(compact('product'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'product_id' => 'required|numeric|exists:accounting_products,id',
            'unit_id' => 'present',
            'recipes' => 'required|array|min:1',
            'recipes.*.product_id' => 'required|integer|exists:accounting_products,id',
            'recipes.*.unit_id' => 'present',
            'recipes.*.quantity' => 'present|integer',
        ];
        $inputs = $this->validate($request, $rules);
        DB::beginTransaction();
        $productRecipe = AccountingProductRecipe::findOrFail($id);
        $productRecipe->update($inputs);
        $productRecipe->items()->delete();
        $productRecipe->items()->createMany($request->recipes);
        DB::commit();
        alert()->success('تم التعديل بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.product-recipes.index');
    }


    public function destroy($id)
    {
        $production = AccountingProductRecipe::findOrFail($id);
        $production->delete();
        alert()->success('تم الحذف بنجاح !')->autoclose(5000);
        return back();
    }


    public function getProductUnits($id)
    {
        $units = AccountingProductSubUnit::whereProductId($id)->get(['id', 'name']);
        $product = AccountingProduct::find($id, [DB::raw('" " as id'), 'main_unit as name']);

        $units->push($product->getAttributes());
        return response()->json($units);
    }
}
