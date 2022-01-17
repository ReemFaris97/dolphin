<?php

namespace App\Http\Controllers\AccountingSystem;

use App\DataTables\AccountingSaleDataTable;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAccountLog;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingOffer;
use App\Models\AccountingSystem\AccountingPackage;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
 use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingReturnSaleItem;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSaleItem;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Models\Client;
use App\Models\User;
use App\Traits\SaleOperation;
use App\Traits\Viewable;
use Carbon\Carbon;
use Cookie;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;

class SaleController extends Controller
{
    use Viewable;
    use SaleOperation;

    private $viewable = 'AccountingSystem.sales.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccountingSaleDataTable $dataTable)
    {
        return $dataTable->render('AccountingSystem.sales.index');
//        $sales =AccountingSale::all();
//        return $this->toIndex(compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=AccountingClient::pluck('name', 'id')->toArray();
        $store_product=AccountingProductStore::where('store_id', auth()->user()->accounting_store_id)->pluck('product_id', 'id')->toArray();
        $products=AccountingProduct::whereIn('id', $store_product)->get();

        return $this->toCreate(compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();
        if (!$request->client_id) {
            $requests['client_id']=AccountingClient::first()->id;
        }
        $session=\App\Models\AccountingSystem\AccountingSession::find($request->session_id);
        $requests['branch_id']=$session->device->model_id;

        if (getsetting('automatic_sales')==1) {
            $requests['account_id']=getsetting('accounting_id_sales');
        }

        $requests['payment']='cash';

        if ($requests['total']==null) {
            $requests['total']= $requests['amount'];
        }
        $requests['store_id']=$session->store_id??1;
        $request['date']=$requests['bill_date'] ;
        $request['debts']=$requests['reminder'] ;

        if ($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0) {
        } elseif ($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0) {
            $request['discount_type']='amount';
            $request['discount']=$requests['discount_byAmount'];
        }


        \DB::beginTransaction();
        $sale=AccountingSale::create($requests);

        $sale->update([
            'bill_num'=>$sale->id."-".$sale->created_at,
]);
      
        foreach ($request['cart'] as $cart) {
            $product=AccountingProduct::find($cart['product_id']);

            $unit=AccountingProductSubUnit::where('id', $cart['unit_id'])->first();

            $quantiy_in_main_unit=$cart['quantity'] * ($unit->main_unit_present??1);
            // $stock=AccountingProductStore::query()
            // ->where('product_id', $product->id)
            // ->where('store_id', $user->accounting_store_id)
            // ->firstOrNew();
            // throw_if($stock->quantity - $quantiy_in_main_unit<0, ValidationException::withMessages(['client_id'=>sprintf("عفوا لايوجد كميات من الوحدة الفرعية %s من المنتج الفرعي %s الكمية المتاحة هي : %s", $unit->name, $product->name, $stock->quantity)]));
            $sale->items()->create([
                'product_id'=>$product->id,
                'quantity' =>  $cart['quantity'],
                'price'=>@$unit->selling_price??$product->selling_price,
                'unit_id'=>$cart['unit_id'],
                'tax'=>$product->total_taxes
            ]);
        }

        // if ($sale->payment=='cash') {
        //     $safe=AccountingSafe::where('device_id', $sale->session->device_id)->first();
        //     if ($safe) {
        //         $safe->update([
        //             'amount' => $safe->amount - $sale->total
        //         ]);
        //     }
        // } elseif ($sale->payment=='agel') {
        //     $client=AccountingClient::find($sale->client_id);
        //     $client->update([
        //         'amount'=>$client->amount +$sale->total
        //     ]);
        // }
        /////////////////////////////////////////Accounts//////////////////////

        $entry=AccountingEntry::create([
            'date'=>$sale->created_at,
            'source'=>'مبيعات',
            'type'=>'automatic',
            'details'=>'فاتوره مبيعات'.$sale->bill_num,
            'status'=>'new'
        ]);

        // if ($sale->payment=='cash') {
        // if (isset($saleAccount)) {


        //حساب  المبيعات والنقدية
        AccountingEntryAccount::create([
            'entry_id' => $entry->id,
            // 'from_account_id' => getsetting('accounting_id_clients'),
            // 'account_id' => getsetting('accounting_id_clients'),
            'account_id'=>getsetting('accounting_id_sales'),
            'amount' => $sale->amount,
            'affect'=>'debtor',
        ]);
        AccountingEntryAccount::create([
            'entry_id' => $entry->id,
            'account_id' => getsetting('accounting_id_clients'),
            'amount' => $sale->amount,
            'affect'=>'creditor',
        ]);


//                dd($sale->getItemCostAttribute());
        //حساب  المبيعات والمخزون
        $storeAccount = AccountingAccount::where('store_id', $sale->store_id)->first()??AccountingAccount::first();
        AccountingEntryAccount::create([
            'entry_id' => $entry->id,
            'from_account_id' =>getsetting('accounting_sales_cost_id'),
            'to_account_id' => @$storeAccount->id,
            'amount' => $sale->getItemCostAttribute(),
        ]);
        // }
        // }
        $debit_account=AccountingAccount::find(getsetting('accounting_id_sales'))??new AccountingAccount();


        $last=AccountingAccountLog::where('account_id', getsetting('accounting_id_clients'))->latest()->first();

        AccountingAccountLog::create([
            'entry_id'=>$entry->id,
            'account_id'=>getsetting('accounting_id_sales'),
            'account_amount_before'=>$last->account_amount_after ??$debit_account->amount,
            'another_account_id'=>getsetting('accounting_id_clients'),
            'amount'=>$sale->total,
            'account_amount_after'=>isset($last)?$last->account_amount_after  - $debit_account->amount :$debit_account->amount - $debit_account->amount,
            'affect'=>'debtor',
        ]);

        $last=AccountingAccountLog::where('account_id', getsetting('accounting_id_clients'))->latest()->first();
        $credit_account=AccountingAccount::find(getsetting('accounting_id_clients'))??new AccountingAccount();

        AccountingAccountLog::create([
            'entry_id'=>$entry->id,
            'account_id'=>getsetting('accounting_id_clients'),
            'account_amount_before'=>@$last->account_amount_after??optional($credit_account->account)->amount,
            'another_account_id'=>getsetting('accounting_id_sales'),
            'amount'=>$sale->total,
            'account_amount_after'=>isset($last)?@$last->account_amount_after+ ($sale->total) : $credit_account->amount + ($sale->total),
        ]);

        DB::commit();
        alert()->success('تمت عملية البيع بنجاح !')->autoclose(5000);
        return back()->with('sale_id', $sale->id)->with('print', $request->print);
    }


    public function index_returns()
    {
        $sales_returns =AccountingReturn::all()->reverse();
        $store_product=AccountingProductStore::where('store_id', auth()->user()->accounting_store_id)->pluck('product_id', 'id')->toArray();
        $products=AccountingProduct::whereIn('id', $store_product)->get();

        return view('AccountingSystem.sales.index_returns', compact('sales_returns', 'products'));
    }

    public function store_returns(Request $request)
    {
        $requests = $request->all();

        DB::beginTransaction();
        if ($request->client!=null) {
            $requests['client_id']=$request->client;
        }
        if (!$request->client_id) {
            $requests['client_id']=Client::latest()->first()->id;
        }


        $user=User::find($requests['user_id']);
        $requests['branch_id']=@($user->store->model_type=='App\Models\AccountingSystem\AccountingBranch')?$user->store->model_id:null;

        $requests['user_id']=auth()->id();
        $returnSale=AccountingReturn::create($requests);

        if ($requests['total']==null) {
            $requests['total']=$returnSale->amount;
        }

        $returnSale->update([
            'bill_num'=>$returnSale->id."-".$returnSale->created_at,
            'user_id'=>$requests['user_id'] ,
            'store_id'=>$user->accounting_store_id,
            'debts'=>$requests['reminder'] ,
            'payment'=>'agel',
            'total'=>$requests['total'],
            'branch_id'=>@($user->store->model_type==AccountingBranch::class)?$user->store->model_id:null,
        ]);
        if ($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0) {
            $returnSale->update([
                'discount_type'=>'percentage',
                'discount'=>$requests['discount_byPercentage'],

            ]);
        } elseif ($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0) {
            $returnSale->update([
                'discount_type'=>'amount',
                'discount'=>$requests['discount_byAmount'],
            ]);
        }
        if ($requests['reminder']==0) {
            $returnSale->update([
                'payment'=>'cash'
            ]);
        }
        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);
        $unit_id = collect($requests['unit_id']);
        $merges = $products->zip($qtys, $unit_id);

        foreach ($merges as $merge) {
            $product=AccountingProduct::find($merge['0']);
            $unit=AccountingProductSubUnit::where('id', $merge['2'])->first();

            
            AccountingReturnSaleItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>optional($unit)->selling_price??$product->selling_price,
                'sale_return_id'=>$returnSale->id
            ]);
        }

        if ($returnSale->payment=='cash') {
            $store_id=auth()->user()->accounting_store_id;
            $store=AccountingStore::find($store_id);
        } elseif ($returnSale->payment=='agel') {
            $client=AccountingClient::find($returnSale->client_id);
            if ($client) {
                $client->update([
                    'amount'=>$client->amount -$returnSale->total
                ]);
            }
        }

        DB::commit();

        alert()->success('تم اضافة  فاتورة  الاسترجاع  بنجاح !')->autoclose(5000);
        return back()->with('sale_id', $returnSale->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = AccountingSale::findOrFail($id);
        $product_items = AccountingSaleItem::where('sale_id', $id)->get();
        $tax_percent = (float)(getsetting('general_taxs'));
        $tax_amount = $sale->product_total() - ($sale->product_total() * 100 / (100 + $tax_percent));
        $qr = GenerateQrCode::fromArray([
            new Seller('مؤسسة دلفن التجارية'), // seller name
            new TaxNumber('300420708200003'), // seller tax number
            new InvoiceDate($sale->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($sale->product_total()), // invoice total amount
            new InvoiceTaxAmount($tax_amount) // invoice tax amount
        ])->toBase64();
        if (\request('print', '7cm') == '7cm') {
            return view('AccountingSystem.sales.show', compact('sale', 'product_items', 'qr'));
        } else {
            return view('AccountingSystem.sell_points.a4-sale', compact('sale', 'product_items', 'qr'));
        }
    }

    public function showBill(AccountingSale $bill)
    {
        return view('AccountingSystem.sell_points.show')->with('bill', $bill);
    }

    public function sale_end(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $session = AccountingSession::findOrFail($request['session_id']);
        $sales_payed_cash = AccountingSale::where('session_id', $request['session_id'])->sum('cash');
        $sales_payed_network = AccountingSale::where('session_id', $request['session_id'])->sum('network');
        $sales_payed = AccountingSale::where('session_id', $request['session_id'])->sum('payed');
        $returns_total = AccountingReturn::where('session_id', $request['session_id'])->sum('total');
        $session->update([
            'end_session' => Carbon::now(),
        ]);

        //    dd($session);
        if (!Hash::check($request['password'], $user->password)) {
            alert()->error('الرقم السرى  خاطئ ,حاول مرة اخرى !')->autoclose(5000);
            return back();
//            return response('false', 200);
        } else {
            // dd('Write here your update password code');
            return view('AccountingSystem.sell_points.session_summary', compact('session', 'sales_payed_cash', 'sales_payed_network', 'sales_payed', 'returns_total'));
        }
    }

    public function end_session($id)
    {
        $session=AccountingSession::findOrFail($id);
        $users=User::where('is_saler', 1)->pluck('name', 'id')->toArray();

        $session->update([
            'status'=>'closed',

        ]);


        //    Session::forget('session_id');

        Cookie::queue(Cookie::forget('session'));
        $device=AccountingDevice::find($session->device_id);
        $device->update([
            'available'=>'1'
        ]);
        $devices=AccountingDevice::where('available', 1)->pluck('name', 'id')->toArray();
        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
            ->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores=AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();
        return view('AccountingSystem.sell_points.login', compact('users', 'devices', 'stores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale =AccountingSale::findOrFail($id);
        $clients=AccountingClient::pluck('name', 'id')->toArray();

        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
            ->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores=AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();
        if ($userstores) {
            $store_product=AccountingProductStore::whereIn('store_id', $userstores)->pluck('product_id', 'id')->toArray();
            $products=AccountingProduct::whereIn('id', $store_product)->get();
        } else {
            $products=[];
        }

        $product_items=AccountingSaleItem::where('sale_id', $id)->get();
        $session=AccountingSession::findOrFail($sale->session_id);


        return view('AccountingSystem.sales.edit', compact('sale', 'clients', 'products', 'product_items', 'session', 'stores'));
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
        $requests=$request->all();
        // dd($requests);

        $sale =AccountingSale::findOrFail($id);
        $sale -> update([
            'bill_num'=>$sale->id."-".$sale->created_at,
            'user_id'=>$requests['user_id'] ,
            'date'=>$requests['bill_date'] ,
            'debts'=>$requests['reminder'] ,
            "totalTaxs" => $requests['totalTaxs'],
            "amount" => $requests['amount'],
            "total" => $requests['total'],
            "cash" => $requests['cash'],
            "network" =>$requests['network'],
            "payed" => $requests['payed'],
        ]);


        $this->createItem($request, $sale);
        $this->editItem($request, $sale);

        alert()->success('تمت تعديل  الفاتوره بنجاح !')->autoclose(5000);
        return back()->with('sale_id', $sale->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingSale::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف  الفاتوره بنجاح !')->autoclose(5000);
        return back();
    }

    public function sale_order($id)
    {
        $package=AccountingPackage::find($id);
        $product_offers=AccountingOffer::where('package_id', $id)->get();

        $sale=AccountingSale::create([
            'amount'=>$package->total,
            'client_id'=>$package->client_id,
            'total'=>$package->total,
            'payment'=>'agel',
            'debts'=>$package->total,
            'package_id'=>$id
        ]);

        foreach ($product_offers as $offer) {
            AccountingSaleItem::create([
                'product_id'=>$offer->product_id,
                'quantity'=>$offer->quantity,
                'price'=>$offer->price,
                'sale_id'=>$sale->id,
            ]);
        }

        alert()->success('تم امر البيع بنجاح !')->autoclose(5000);
        return back();
    }

    public function returns($id)
    {
        $sales=AccountingSale::whereDate('created_at', '>=', Carbon::now()->subDays(getsetting('return_period')))
            ->pluck('id', 'id')->toArray();
        $session=AccountingSession::findOrFail($id);
//        $session=AccountingSession::find(Cookie::get('session'));
        $clients=AccountingClient::pluck('name', 'id')->toArray();
        $categories=AccountingProductCategory::pluck('ar_name', 'id')->toArray();
        $sales_items=AccountingSaleItem::where('sale_id', $id)->pluck('product_id', 'id')->toArray();
        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
            ->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores=AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();

        $products=[];


        return view('AccountingSystem.sales.returns', compact('sales', 'session', 'clients', 'categories', 'products', 'stores'));
    }

    public function sale_details($id)
    {
        $items=AccountingSaleItem::where('sale_id', $id)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();
        return response()->json([
            'status'=>true,
            'items'=>view('AccountingSystem.sales.items')->with('items', $items)->render()
        ]);
    }

    public function remove_Sale($id)
    {
        $item=AccountingSaleItem::find($id);

        $item->delete();
    }

    public function confirm_user(Request $request)
    {
        $saler = User::where('email', $request['email'])->where('delete_product', 1)->first();
        if ($saler) {
            if ($saler->is_saler == 1) {
                if (Hash::check($request['password'], $saler->password)) {
                    return response()->json([
                        'status' => true,
                        'data' => ('success')
                    ]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'data' => ('failed')
        ]);
    }

    public function show_return($id)
    {
        $sale_return =AccountingReturn::findOrFail($id);
        $product_items=AccountingReturnSaleItem::where('sale_return_id', $id)->get();
        return view('AccountingSystem.sales.show_return', compact('sale_return', 'product_items'));
    }

    public function destroy_return($id)
    {
        $returns =AccountingReturn::findOrFail($id);
        $returns->delete();
        alert()->success('تم حذف  الفاتوره بنجاح !')->autoclose(5000);
        return back();
    }

    public function showInvoice($uuid)
    {
        $sale =AccountingSale::where('uuid', $uuid)->first();
        $product_items=AccountingSaleItem::whereRelation('sale', 'uuid', $uuid)->get();
        return $this->toShow(compact('sale', 'product_items'));
    }
}
