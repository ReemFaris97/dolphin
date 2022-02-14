<?php

namespace App\Http\Controllers\AccountingSystem\AccountingCompanies;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.AccountingCompanies.stores.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches_id = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("id", "id")
            ->toArray();
        $stores_company = AccountingStore::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingCompany"
        )
            ->where("model_id", auth("accounting_companies")->user()->id)
            ->get();
        $stores_branch = AccountingStore::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingBranch"
        )
            ->whereIn("model_id", $branches_id)
            ->get();

        $stores = $stores_company->merge($stores_branch);
        // dd($stores);
        return $this->toIndex(compact("stores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("name", "id")
            ->toArray();
        return $this->toCreate(compact("branches"));
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
            "ar_name" => "required|string|max:191",
            "en_name" => "nullable|string|max:191",
            "image" => "nullable|sometimes|image",
        ];
        $this->validate($request, $rules);
        $requests = $request->except("image");
        if ($request->hasFile("image")) {
            $requests["image"] = saveImage($request->image, "photos");
        }

        if (
            ($requests["company_id"] == null) &
            ($requests["branch_id"] != null)
        ) {
            $requests["model_id"] = $requests["branch_id"];
            $requests["model_type"] =
                "App\Models\AccountingSystem\AccountingBranch";
        }
        if (
            ($requests["branch_id"] == null) &
            ($requests["company_id"] != null)
        ) {
            $requests["model_id"] = $requests["company_id"];
            $requests["model_type"] =
                "App\Models\AccountingSystem\AccountingCompany";
        }
        //dd($requests);
        AccountingStore::create($requests);

        alert()
            ->success("تم اضافة  الفرع بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.stores.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = AccountingBranch::findOrFail($id);
        $shifts = AccountingBranchShift::where("branch_id", $id)->get();
        return $this->toShow(compact("branch", "shifts"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = AccountingStore::findOrFail($id);

        $branches = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("name", "id")
            ->toArray();
        return $this->toEdit(compact("store", "branches"));
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
        $store = AccountingStore::findOrFail($id);

        $rules = [
            "ar_name" => "required|string|max:191",
            "en_name" => "nullable|string|max:191",
            "image" => "nullable|sometimes|image",
        ];
        //   dd($request->all());
        $this->validate($request, $rules);
        $requests = $request->except("image");
        if ($request->hasFile("image")) {
            $requests["image"] = saveImage($request->image, "photos");
        }

        $store->update($requests);

        if (array_key_exists("company_id", $requests)) {
            $store->update([
                "model_id" => $requests["company_id"],
            ]);
        } elseif (array_key_exists("branch_id", $requests)) {
            $store->update([
                "model_id" => $requests["branch_id"],
            ]);
        }
        alert()
            ->success("تم تعديل  المستودع بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.stores.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = AccountingStore::findOrFail($id);
        $store->delete();
        alert()
            ->success("تم حذف  المستودع بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
