<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Bank;
use App\Models\BankDeposit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BankDepositsController extends Controller
{

    use Viewable;

    private $viewable = 'distributor.bank_deposits.';


    public function index()
    {
        $bank_deposits = BankDeposit::query()->with(['distributor', 'bank'])->latest();

        $bank_deposits->when(\request()->has('confirmed'), function ($q) {
            $q->where('confirmed', \request('confirmed'));
        });

        $bank_deposits->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('deposit_date', [\request('from'), \request('to')]);
        });

        $bank_deposits = $bank_deposits->get();
        $total = $bank_deposits->sum('amount');
        return $this->toIndex(compact('bank_deposits', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::distributor(1)->pluck('name', 'id')->toArray();
        $banks = Bank::pluck('name', 'id')->toArray();
        return $this->toCreate(compact('users', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//dd($request->all());
//dd(Carbon::now()->format('m/d/Y, h:i:s A'));
        $rules = [
            'user_id' => 'required|integer|exists:users,id',
            'bank_id' => 'required_if:type,==,bank_transaction|integer|nullable|exists:banks,id',
            'deposit_number' => "required_if:type,==,bank_transaction|nullable|string|max:191",
//             'deposit_date' =>"required|date_format:mm/d/Y, H:i:s A",
            'image' => "required||mimes:jpg,jpeg,gif,png",
        ];
        $this->validate($request, $rules);
        $request['deposit_date'] = Carbon::parse($request['deposit_date']);
        if ($request->hasFile('image') && $request->image != null) {
            $request['image'] = saveImage($request->image, 'photos');
        }
        BankDeposit::create($request->all());
        toast('تم إضافة الايداع بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.bank-deposits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank_deposit = BankDeposit::findOrFail($id);
        $users = User::whereIsDistributor(1)->get()->reverse();
        return $this->toEdit(compact('users', 'bank_deposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bank_deposit = BankDeposit::find($id);

        $rules = [
//            'user_id'=>'required|numeric|exists:users,id|unique:distributor_bank_deposits,user_id,'.$id,
            'bank_deposit_name' => 'required|string|max:191',
            'bank_deposit_model' => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $bank_deposit->update($request->all());
        toast('تم تعديل الايداع بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.bank-deposits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankDeposit::find($id)->delete();
        toast('تم حذف الايداع بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.bank-deposits.index');
    }

    public function getUserWallet($id)
    {

        $wallet = User::find($id)->distributor_wallet();

        return response()->json([
            'status' => true,
            'wallet' => $wallet
        ]);
    }

    public function Confirm($id)
    {
        $bank_deposit = BankDeposit::findOrFail($id);
        $bank_deposit->update([
            'confirmed_at' => now(),
            'confirmed' => 1
        ]);
        toast('تم تأكيد الايداع بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.bank-deposits.index');
    }

}
