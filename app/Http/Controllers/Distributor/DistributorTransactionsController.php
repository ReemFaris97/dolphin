<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Validation\ValidationException;

class DistributorTransactionsController extends Controller
{
    use Viewable;
    private $viewable= 'distributor.transactions.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DistributorTransaction::all()->reverse();
        return $this->toIndex(compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereIsDistributor(1)->get();
        return $this->toCreate(compact('users'));
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
            'sender_id'=>'required|exists:users,id',
            'receiver_id'=>'required|different:sender_id|exists:users,id',
            'amount'=>'required|numeric'
        ];
        $messages = [
            'receiver_id.different'=>"يجب ان يكون المرسل والمستلم مندوبين مختلفين"
        ];
        $this->validate($request,$rules,$messages);
        if (User::findOrFail($request->sender_id)->distributor_wallet() < $request->amount) {
            throw ValidationException::withMessages(['amount' => 'الملبغ المطلوب اكبر من الموجود فى المحفظة']);
        }
        $request->merge([
            'receiver_type' => User::class,
            'sender_type' => User::class,
        ]);
        DistributorTransaction::create($request->all());
        toast('تم التحويل بنجاح','success','top-right');
        return redirect()->route('distributor.transactions.index');
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
        $transaction = DistributorTransaction::findOrFail($id);
        $users = User::whereIsDistributor(1)->get();
        return $this->toEdit(compact('transaction','users'));
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
        $transaction = DistributorTransaction::find($id);
        $rules = [
            'sender_id'=>'required|exists:users,id',
            'receiver_id'=>'required|different:sender_id|exists:users,id',
            'amount'=>'required|numeric'
        ];
        $messages = [
            'receiver_id.different'=>"يجب ان يكون المرسل والمستلم مندوبين مختلفين"
        ];
        $this->validate($request,$rules,$messages);
        $request->merge([
            'receiver_type' => User::class,
            'sender_type' => User::class,
        ]);
        $transaction->update($request->all());
        toast('تم تعديل التحويل بنجاح','success','top-right');
        return redirect()->route('distributor.transactions.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = DistributorTransaction::find($id);
        $transaction->delete();
        toast('تم حذف التحويل بنجاح','success','top-right');
        return redirect()->route('distributor.transactions.index');
    }
}
