<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Bank;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BankController extends Controller
{
    use Viewable;

    private $viewable = 'distributor.banks.';

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $rules = ;
        $this->validate($request, ['name' => 'required|string|max:191']);
        Bank::create($request->all());
        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.banks.index');

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
        $bank = Bank::findOrFail($id);
        return $this->toEdit(compact('bank'));
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
        $bank = Bank::find($id);
        $this->validate($request, ['name' => 'required|string|max:191']);
        $bank->update($request->all());
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.banks.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return back();


    }


    /*
        public function block($id)
        {
            $store_bank = Bank::find($id);

            $blocked_at = $store_bank->blocked_at;
            if ($blocked_at == null) {
                $store_bank->fill(['blocked_at' => Carbon::now(env('TIME_ZONE', 'Asia/Riyadh'))]);
            } else {
                $store_bank->fill(['blocked_at' => null]);
            }
            $store_bank->save();
            toast('تم التعديل', 'success', 'top-right');
            return back();
        }*/
}
