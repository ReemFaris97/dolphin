<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDocument;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $types = ['employee'=>User::class,'branch'=>AccountingBranch::class];
    public function index($type)
    {
        $newType = ($type == 'employee' ? $type : $this->types[$type]);
        $documents = AccountingDocument::with('documentable')->where('documentable_type', $newType)->get();
        return view('AccountingSystem.documents.index', compact('documents', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type){
        if($type == 'employee'){
            $query = '$data["targets"] = '.$this->types[$type].'::get(["id","name"]);';
        }else{
            $query = '$data["targets"] = '.$this->types[$type].'::get(["id","name"]);';
        }
        $data['type'] = $type;
        eval($query);
        if(request()->has('parent')){
            $data['document'] = AccountingDocument::with('documentable')->find(request('parent'));
        }
        return view('AccountingSystem.documents.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$type)
    {

            $rules=[
                'document_name'=>'required',
                'document_number'=>'required',
                'documentable_id'=>'required',
                'start_date'=>'required|date|before:end_date',
                'end_date'=>'required',
                // 'notes'=>'required',
                'document'=>'required|file'
            ];

        $this->validate($request,$rules);
        $requests = $request->all();

        $inputs = $request->except('_token');
        $inputs['documentable_type'] = ($type == 'employee' ? $type : $this->types[$type]);
        if($request->file('document')){
            $inputs['document'] = uploader($request,'document');
        }
        AccountingDocument::create($inputs);
        alert()->success('تم اضافة  المسمى الوظيفى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$type)
    {
        $document = AccountingDocument::find($id);
        if($type == 'employee'){
            $query = '$targets = '.$this->types[$type].'::get(["id","name"]);';
        }else{
            $query = '$targets = '.$this->types[$type].'::get(["id","name"]);';
        }
        eval($query);
        return view('AccountingSystem.documents.edit',compact('type','targets','document'));
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

        $ules=[
                'document_name'=>'required',
                'document_number'=>'required',
                'documentable_id'=>'required',
                'start_date'=>'required|date|before:end_date',
                'end_date'=>'required',

            ];
        $document = AccountingDocument::find($id);
        $inputs = $request->except('_token');
        if($request->file('document')){
            $inputs['document'] = uploader($request,'document');
        }else{
            unset($inputs['document']);
        }
        $document->update($inputs);
     alert()->success('تم اضافة  المسمى الوظيفى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id){
        AccountingDocument::find($id)->delete();
        alert()->success('تم  الحذف بنجاح !')->autoclose(5000);
        return back();
    }
}
