<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAllowance;
use App\Models\AccountingSystem\AccountingTemplate;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.templates.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates =AccountingTemplate::groupBy('report_no')->get();

        return $this->toIndex(compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=AccountingAccount::select(['ar_name','id'])->get();
        return $this->toCreate(compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $templates= $request['Nodes'];
        foreach($templates as $key=>$template){
            if (str_contains($template['first_account_id'],'x-')===false && str_contains($template['second_account_id'],'x-')=== false ) {
               $obj[$key]= AccountingTemplate::create([
                    'first_account_id'=>$template['first_account_id'],
                    'second_account_id'=>$template['second_account_id'],
                    'operation'=>$template['operation'],
                    'result'=>$template['result'],
                   'report_no'=>$request['report_no'],
                ]);
            }
            elseif(str_contains($template['first_account_id'],'x-')==true && str_contains($template['second_account_id'],'x-')== false ){

                $ref = substr_count( $template['first_account_id'],2);
                AccountingTemplate::create([
                    'first_account_id'=>null,
                    'second_account_id'=>$template['second_account_id'],
                    'operation'=>$template['operation'],
                    'result'=>$template['result'],
                    'template_id'=>$obj[$ref]->id,
                    'report_no'=>$request['report_no'],


                ]);
            }
            else{
                $ref = substr_count( $template['second_account_id'],2);
                AccountingTemplate::create([
                    'first_account_id'=>$template['first_account_id'],
                    'second_account_id'=>null,
                    'operation'=>$template['operation'],
                    'result'=>$template['result'],
                    'template_id'=>$obj[$ref]->id,
                    'report_no'=>$request['report_no'],
                ]);

            }

        }

        alert()->success('تم اضافة  البدلات بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.templates.index');

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
        $allowance =AccountingAllowance::findOrFail($id);
        return $this->toEdit(compact('allowance'));
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
        $allowance =AccountingAllowance::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $allowance->update($requests);
        alert()->success('تم تعديل البدلات بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.allowances.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingAllowance::find($id)->delete();
        alert()->success('تم  الحذف بنجاح !')->autoclose(5000);
        return back();
    }
}
