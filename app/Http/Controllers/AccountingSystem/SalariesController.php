<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingDebtPayment;
use App\Models\AccountingSystem\AccountingSalary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalariesController extends Controller
{
    public function index(Request $request){
        $users = User::with([
                'allowances', 'debts',
                'salaries' => function ($q) {
                    $this->dateFilter($q, 'date');
                },
                'bonus_discount' => function ($q) {
                    $this->dateFilter($q, 'date');
                },
            ])
        ->whereMonth('created_at', '<=',$request->month?? now()->month)

          ->whereYear('created_at','<=',$request->year?? now()->year)

                ->get()->transform(function ($q) {
                    $newData['name'] = $q->name;
                    $newData['id'] = $q->id;
                    $newData['salary'] = $q->salary ?? 0;
                    $newData['bonus'] = $q->bonus_discount->where('type', 'bonus')->sum('value');
                    $newData['discount'] = $q->bonus_discount->where('type', 'discount')->sum('value');
                    $newData['allowance'] = $q->allowances->sum('pivot.value');
                    $newData['debts'] = $q->debts->load('payments')->transform(function ($debt) {
                        $debt['_payments'] = collect($debt->paymentWithPayed())
                            ->where('is_current', true)->where('payed', false);
                        $debt['total_amount'] = $debt['_payments']->sum('amount');
                        return $debt;
                    });
                    $newData['total'] = $newData['salary'] + $newData['bonus'] + $newData['allowance'] - $newData['discount'] - $newData['debts']->sum('total_amount');
                    $newData['total_without_debts'] = $newData['salary'] + $newData['bonus'] + $newData['allowance'] - $newData['discount'];
                    $newData['is_payed'] = $q->salaries->count() > 0;
                    return (object)$newData;
                });
            $month = ($request->month ?? now()->month);
            if ($month < 10) {
                $month = '0' . $month;
            }
            $date = '01-' . $month . '-' . ($request->year ?? now()->year);

        return view('AccountingSystem.salaries.index',compact('users','date'));
    }

    public function dateFilter($q,$column){
        $request = request();
        $month = ($request->month??now()->month);
        if($month < 10){
            $month = '0'.$month;
        }
        $monthYear = $month.'-'.($request->year??now()->year);
        $dates[] = Carbon::parse('01-'.$monthYear);
        $dates[] = Carbon::parse('31-'.$monthYear);
        if($column == 'pay_from'){
            $dates[0] = Carbon::parse('01-01-2000');
            $q = $q->wherePayed(0);
        }
        return $q->whereBetween($column,$dates);
    }

    public function store(Request $request){
        $inputs = $request->all();
        $inputs['date'] = Carbon::parse($request->date);
        $inputs['typeable_type'] = 'App\Models\User';
        if($inputs['debts'] == 'payed'){
            $debts = json_decode($request->debts_object);
            foreach($debts as $debt){
                foreach((array)$debt->_payments as $payment){
                    $payments[] = [
                        'debt_id'=>$debt->id,
                        'date'=>Carbon::parse($payment->date),
                        'value'=>$payment->amount,
                        'created_at'=>now()
                    ];
                }
            }
            if(isset($payments)){
                (new AccountingDebtPayment())->insert($payments);
            }
        }
        AccountingSalary::create($inputs);
        alert()->success('تم الاضافة بنجاح !')->autoclose(5000);
        return back();
    }

}
