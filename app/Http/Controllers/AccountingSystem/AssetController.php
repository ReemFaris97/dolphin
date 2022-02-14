<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Models\AccountingSystem\AccountingCurrency;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingPayment;
use App\Traits\Viewable;
use DB;

class AssetController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.assetss.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = AccountingAsset::where("type", "asset")
            ->get()
            ->reverse();

        return $this->toIndex(compact("assets"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = AccountingCurrency::pluck("ar_name", "id")->toArray();
        $payments = AccountingPayment::where("active", "1")
            ->pluck("name", "id")
            ->toArray();
        $accounts = AccountingAccount::select(
            "id",
            DB::raw("concat(ar_name, ' - ',code) as code_name")
        )
            ->where("kind", "!=", "sub")
            ->pluck("code_name", "id")
            ->toArray();
        return $this->toCreate(compact("currencies", "payments", "accounts"));
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
        $requests = $request->all();

        AccountingAsset::create($requests);
        alert()
            ->success("تم اضافة  الاصل بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.assets.index");
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
        $asset = AccountingAsset::findOrFail($id);

        return $this->toEdit(compact("asset"));
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
        $asset = AccountingAsset::findOrFail($id);
        $rules = [
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $asset->update($requests);
        alert()
            ->success("تم تعديل لاصل بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.assets.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = AccountingAsset::findOrFail($id);
        $asset->delete();
        alert()
            ->success("تم حذف  الاصل بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
