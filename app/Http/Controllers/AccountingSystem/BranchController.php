<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BranchController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.branches.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = AccountingBranch::all()->reverse();
        return $this->toIndex(compact("branches"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = AccountingCompany::pluck("name", "id")->toArray();
        return $this->toCreate(compact("companies"));
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
            "name" =>
                "required|string|max:191|branch_name:accounting_branches,name,company_id," .
                $request["name"] .
                "," .
                $request["company_id"],
            "phone" => "required|numeric|unique:accounting_branches,phone",
            "email" => "required|string|unique:accounting_branches,email",
            "password" => "required|string|max:191",
            "image" => "nullable|sometimes|mimes:jpg,jpeg,gif,png",
            "company_id" => "required|numeric|exists:accounting_companies,id",
        ];
        $messsage = [
            "name.branch_name" => "اسم الفرع موجود بالفعل بالشركة",
        ];
        $this->validate($request, $rules, $messsage);
        $requests = $request->except("image");

        if ($request->hasFile("image")) {
            $requests["image"] = saveImage($request->image, "photos");
        }
        AccountingBranch::create($requests);
        alert()
            ->success("تم اضافة  الفرع بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.branches.index");
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
        $branch = AccountingBranch::findOrFail($id);
        $companies = AccountingCompany::pluck("name", "id")->toArray();

        return $this->toEdit(compact("branch", "companies"));
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
        $branch = AccountingBranch::findOrFail($id);

        $rules = [
            "name" => "required|string|max:191",
            "phone" =>
                "required|numeric|unique:accounting_branches,phone," .
                $branch->id,
            "email" =>
                "required|string|unique:accounting_branches,email," .
                $branch->id,
            "image" => "nullable|sometimes|image",
            "company_id" => "required|numeric|exists:accounting_companies,id",
        ];
        $this->validate($request, $rules);
        $requests = $request->except("image");
        if ($request->hasFile("image")) {
            $requests["image"] = saveImage($request->image, "photos");
        }
        $branch->update($requests);
        alert()
            ->success("تم تعديل  الفرع بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.branches.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = AccountingBranch::findOrFail($id);
        $branch->delete();
        alert()
            ->success("تم حذف  الفرع بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
