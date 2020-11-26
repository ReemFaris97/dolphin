<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Bank;
use App\Models\DistributorCar;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BankController extends Controller
{

    use Viewable;
    private  $viewable = 'suppliers.banks.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all()->reverse();
        return $this->toIndex(compact('banks'));
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
            'bank_account_number'=>"required|string|max:191",
        ];
        $this->validate($request,$rules);
        Bank::create($request->all());
//        toast('تم إضافة البنك بنجاح','success','top-right');
        alert()->success('تم إضافة البنك    بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.banks.index');
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
        $bank = Bank::findOrFail($id);

        return $this->toEdit(compact('bank'));
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
        $bank = Bank::find($id);

        $rules = [

            'name'=>'required|string|max:191',
            'bank_account_number'=>"required|string|max:191",
        ];
        $this->validate($request,$rules);
        $bank->update($request->all());
//        toast('تم تعديل البنك بنجاح','success','top-right');
        alert()->success('تم تعديل البنك    بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::find($id)->delete();
        alert()->success('تم حذف البنك    بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.banks.index');
    }
}
