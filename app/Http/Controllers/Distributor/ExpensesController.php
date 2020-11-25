<?php

namespace App\Http\Controllers\Distributor;

use App\Models\ExpenditureClause;
use App\Models\ExpenditureType;
use App\Models\Expense;
use App\Models\Reader;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ExpensesController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.expenses.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return $this->toIndex(compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenditure_clauses=ExpenditureClause::pluck('name','id');
        $expenditure_types=ExpenditureType::pluck('name','id');
        $readers=Reader::pluck('name','id');
        $users=User::where('is_distributor',1)->pluck('name','id');
        return $this->toCreate(compact('expenditure_clauses','expenditure_types','users','readers'));
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

            'expenditure_clause_id'=>'required|numeric|exists:expenditure_clauses,id',
            'expenditure_type_id'=>'required|numeric|exists:expenditure_types,id',
            'user_id'=>'required|numeric|exists:users,id',
            'date'=>'required|date',
            'time'=>'required|string',
            'amount'=>'required|numeric',
            'notes'=>'sometimes|string',
            'image'=>'sometimes|image',
            'reader_name'=>"sometimes|string|max:191",
            'reader_number'=>"sometimes|numeric",
            'reader_image'=>"sometimes|image",

        ];
        $this->validate($request,$rules);
        $inputs=$request->all();

        if ($request->hasFile('image')&& $request->image !=null) {

            $inputs['image'] =  saveImage($request->image, 'photos');
        }
        if ($request->hasFile('reader_image')&& $request->reader_image !=null) {
            $inputs['reader_image'] = saveImage($request->reader_image, 'photos');
        }
        $inputs['sanad_No']=mt_rand(1000000, 9999999);
       Expense::create($inputs);
        toast('تم الإضافة بنجاح','success','top-right');
        return redirect()->route('distributor.expenses.index');
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
        $expense =Expense::findOrFail($id);
        $expenditure_clauses=ExpenditureClause::pluck('name','id');
        $expenditure_types=ExpenditureType::pluck('name','id');
        $users=User::pluck('name','id');
        $readers=Reader::pluck('name','id');
        return $this->toEdit(compact('expense','users','expenditure_types','expenditure_clauses','readers'));


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
       $expense = Expense::findOrFail($id);
        $rules = [
            'expenditure_clause_id'=>'required|numeric|exists:expenditure_clauses,id',
            'expenditure_type_id'=>'required|numeric|exists:expenditure_types,id',
            'user_id'=>'required|numeric|exists:users,id',
            'date'=>'required|date',
            'time'=>'required|string',
            'amount'=>'required|numeric',
            'notes'=>'sometimes|string',
            'image'=>'sometimes|image',
            'reader_name'=>"sometimes|string|max:191",
            'reader_number'=>"sometimes|numeric",
            'reader_image'=>"sometimes|image",

        ];
        $this->validate($request,$rules);
        $expense->update($request->all());
        toast('تم التعديل بنجاح','success','top-right');
        return redirect()->route('distributor.expenses.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
            toast('تم الحذف بنجاح', 'success','top-right');
            return back();
    }
}
