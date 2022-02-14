<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\TransactionResource;
use App\Models\DistributorTransaction;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DistributorOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    use ApiResponses, DistributorOperation;

    public function index()
    {
        $transactions = DistributorTransaction::query()
            ->IsTransaction()
            ->UserTransactions(auth()->id())
            ->latest()
            ->paginate($this->paginateNumber);
        return $this->apiResponse(new TransactionResource($transactions));
    }

    public function store(Request $request)
    {
        $rules = [
            "distributor_id" => [
                "nullable",
                "integer",
                "exists:users,id",
                Rule::requiredIf(in_array($request->type, ["send", "receive"])),
            ],
            "sender_id" => "required_if:type,confirm|integer|exists:users,id",
            "amount" => [
                "nullable",
                "numeric",
                "exists:users,id",
                Rule::requiredIf(in_array($request->type, ["send", "receive"])),
            ],
            "type" => "required|in:send,receive,confirm",
            //  'signature' => 'nullable|string',
            "transaction_id" => "nullable|exists:distributor_transactions,id",
        ];
        $validation = $this->apiValidation($request, $rules);

        if ($validation instanceof Response) {
            return $validation;
        }

        if ($request->distributor_id == auth()->user()->id) {
            return $this->apiResponse(
                null,
                "لا يمكنك ارسال واستقبال الاموال من نفسك",
                400
            );
        }

        if ($request->type == "send") {
            if (
                auth()
                    ->user()
                    ->distributor_wallet() < $request->amount
            ) {
                return $this->apiResponse(
                    null,
                    "الملبغ المطلوب اكبر من الموجود فى المحفظة",
                    400
                );
            }

            $request["sender_type"] = $request["receiver_type"] = User::class;
            $request["sender_id"] = auth()->user()->id;
            $request["receiver_id"] = $request->distributor_id;
            $this->AddTransaction($request);
        } elseif ($request->type == "receive") {
            $transaction = DistributorTransaction::find(
                $request->transaction_id
            );

            $signature = \Str::random(6);

            //            if ($transaction->signature != $request->signature) {
            //                return $this->apiResponse(
            //                    null,
            //                    'لم تتم العملية تم تسجيل توقيع خطأ',
            //                    400
            //                );
            //            }
            $transaction->update([
                "received_at" => Carbon::now(),
                "signature" => $signature,
            ]);
        } elseif ($request->type == "confirm") {
            $transaction = DistributorTransaction::find(
                $request->transaction_id
            );
            if (
                $request->sender_id == auth()->user()->id and
                $transaction->signature == $request->signature
            ) {
                $transaction->update([
                    "confirmed_at" => Carbon::now(),
                ]);
            }
        }
        return $this->apiResponse("العملية تمت بنجاح");
    }

    public function getWallet()
    {
        return $this->apiResponse([
            "walllet" => (string) auth()
                ->user()
                ->distributor_wallet(),
        ]);
    }
}
