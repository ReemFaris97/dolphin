<?php

namespace App\Http\Controllers\AccountingSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingTaxBand;
use App\Traits\Viewable;
class TaxsController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.taxs.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxs = AccountingTaxBand::all()->reverse();
        return $this->toIndex(compact("taxs"));
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
            "name" =>
                "required|string|max:191|unique:accounting_tax_bands,name",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        AccountingTaxBand::create($requests);

        alert()
            ->success("تم اضافة  الضريبة بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.taxs.index");
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
        $tax = AccountingTaxBand::findOrFail($id);

        return $this->toEdit(compact("tax"));
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
        $tax = AccountingTaxBand::findOrFail($id);

        $rules = [
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $tax->update($requests);
        alert()
            ->success("تم تعديل  الضريبة بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.taxs.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = AccountingTaxBand::findOrFail($id);
        $tax->delete();
        alert()
            ->success("تم حذف  الضريبه بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
