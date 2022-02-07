<?php

namespace App\Http\Controllers\AccountingSystem\AccountingCompanies;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingMoneyTransaction;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class TranscationController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.AccountingCompanies.transactions.";
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
        $transactions_company = AccountingMoneyTransaction::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingCompany"
        )
            ->where("model_id", auth("accounting_companies")->user()->id)
            ->get();
        $transactions_branch = AccountingMoneyTransaction::where(
            "model_type",
            "App\Models\AccountingSystem\AccountingBranch"
        )
            ->whereIn("model_id", $branches_id)
            ->get();

        $transactions = $transactions_company->merge($transactions_branch);
        return $this->toIndex(compact("transactions"));
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
        $clauses = AccountingMoneyClause::pluck("ar_name", "id")->toArray();

        return $this->toCreate(compact("branches", "clauses"));
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
            "notes" => "nullable|string",
            "amount" => "nullable|string",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

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

        AccountingMoneyTransaction::create($requests);
        alert()
            ->success("تم اضافة  التحويل   بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.transactions.index");
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
        $transaction = AccountingMoneyTransaction::findOrFail($id);
        $branches = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("name", "id")
            ->toArray();
        $clauses = AccountingMoneyClause::pluck("ar_name", "id")->toArray();

        return $this->toEdit(compact("transaction", "branches", "clauses"));
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
        $transaction = AccountingMoneyTransaction::findOrFail($id);

        $rules = [
            "ar_name" => "required|string|max:191",
            "en_name" => "nullable|string|max:191",
            "ar_description" => "nullable|string",
            "en_description" => "nullable|string",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        $transaction->update($requests);
        alert()
            ->success("تم تعديل  البند بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.transactions.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = AccountingMoneyTransaction::findOrFail($id);
        $transaction->delete();
        alert()
            ->success("تم حذف  التحويل بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
