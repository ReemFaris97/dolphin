<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\TransactionResource;
use App\Models\DistributorTransaction;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DistributorOperation;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class TransactionController extends Controller
{
    use ApiResponses,DistributorOperation;


    public function index(){

        $transactions = DistributorTransaction::Where('receiver_id',auth()->user()->id)
            ->paginate($this->paginateNumber);
        return $this->apiResponse(new TransactionResource($transactions));
    }

    public function store(Request $request){

        $rules = [
           'distributor_id' => 'required|integer|exists:users,id',
            'amount'=>'required|integer',
            'type'=>'required|in:send,receive',
            'signature'=>'nullable|string',
            'transaction_id'=>'nullable|exists:distributor_transactions,id'
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        if ($request->distributor_id == auth()->user()->id)
        {
            return $this->apiResponse(null,'لا يمكنك ارسال واستقبال الاموال من نفسك',400);
        }

        if ($request->type == "send")
        {

            $request['sender_id'] = auth()->user()->id;
            $request['receiver_id'] = $request->distributor_id;
            $this->AddTransaction($request);
        }
    else
        {
            $transaction = DistributorTransaction::find($request->transaction_id);
            $transaction->update(['is_received'=>1]);
        }
        return $this->apiResponse('العملية تمت بنجاح');
    }

}
