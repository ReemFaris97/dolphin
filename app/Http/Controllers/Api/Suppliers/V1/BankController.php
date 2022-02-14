<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Supplers\BankResource;
use App\Models\Supplier\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return \responder::success(BankResource::collection($user->banks));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            "name" => "required|string",
            "owner_name" => "required|string",
            "iban" => "required|string",
        ]);
        $user = auth()->user();
        $bank = $user->supplier->banks()->create($inputs);
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    "إضافة حساب بنكي رقم  {$bank->id}"
                )
            );
        return \responder::success(new BankResource($bank));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $inputs = $request->validate([
            "name" => "sometimes|string",
            "owner_name" => "sometimes|string",
            "iban" => "sometimes|string",
        ]);

        $bank->update($inputs);
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    " تعديل حساب بنكي رقم {$bank->id}"
                )
            );

        return \responder::success(new BankResource($bank));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    " حذف حساب بنكي رقم {$bank->id}"
                )
            );
        return \responder::success("تم الحذف بنجاح !");
    }
}
