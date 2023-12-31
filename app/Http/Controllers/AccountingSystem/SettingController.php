<?php


namespace App\Http\Controllers\AccountingSystem;



use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingSetting;
use App\Traits\SettingOperation;
use App\Setting;
use Artisan;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Http\Request;



class SettingController extends Controller

{

    use SettingOperation;



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

//        Activity::log('زيارة لصفحة الإعدادات');


     //dd("dddvvc");
        $settings = AccountingSetting::groupBy('page')->distinct()->where('accounting_type',Null)->get();

        return view('AccountingSystem.settings.index',compact('settings'));

    }



    public function show($slug)

    {
        // dd("ddd");

        $settings = AccountingSetting::where('slug', $slug)->get();

        if (!$settings)


            return redirect('/accounting/settings');

        $settings_page = $settings->pluck('page')->first();

        if ($settings_page == 'اعدادات النظام المالى')
        {
            $chart_accounts = AccountingAccount::all();
            $accounts = AccountingAccount::where('kind','main')->get();
        return view('AccountingSystem.settings.accounts_setting')
            ->with('settings_page', $settings_page)
            ->with('settings', AccountingSetting::where('slug', $slug)->get())
            ->with('chart_accounts', $chart_accounts)
            ->with('accounts', $accounts);

    }elseif ($settings_page == 'اعاده تعين حسابات المشتريات')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.purchases_setting')
                ->with('settings_page', $settings_page)
                ->with('purchases_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_purchases')->get())
                ->with('supplier_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_supplier')->get())
                ->with('returns_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_purchases_returns')->get())
                ->with('discounts_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_purchases_returns')->get())

                ->with('chart_accounts', $chart_accounts);

        }elseif ($settings_page == 'اعاده تعين حسابات المبيعات')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.sales_setting')
                ->with('settings_page', $settings_page)
                ->with('sales_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_sales')->get())
                ->with('clients_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_clients')->get())
                ->with('returns_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_sales_returns')->get())
                ->with('sales_cost_settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_sales_cost')->get())

                ->with('chart_accounts', $chart_accounts);

        }elseif ($settings_page == 'اعاده تعين حسابات المخزون')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.stores_setting')
                ->with('settings_page', $settings_page)
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_stores')->get())
            ->with('chart_accounts', $chart_accounts);

        }elseif ($settings_page == 'القيود المحاسبيه')
        {

            return view('AccountingSystem.settings.entries_setting')
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_entries')->get());

        }elseif ($settings_page == 'اعاده تعين حسابات النقدية')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.cash_setting')
                ->with('settings_page', $settings_page)
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_cash')->get())
                ->with('chart_accounts', $chart_accounts);

        }elseif ($settings_page == 'تعين خيارات الدفع') {
            $payments = AccountingPayment::all();
            return view('AccountingSystem.settings.payment_setting')
                ->with('settings_page', $settings_page)
                ->with('setting', AccountingSetting::where('slug', $slug)->where('accounting_type', 'Acc_payment')->first())
                ->with('payments', $payments);
        }elseif ($settings_page == 'تعين حسابات البنوك والصناديق')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.banks_safes_setting')
                ->with('settings_page', $settings_page)
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_banks_safes')->get())
                ->with('chart_accounts', $chart_accounts);

        }elseif ($settings_page == 'تعين حسابات الاجور')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.salary_setting')
                ->with('settings_page', $settings_page)
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_salaries')->get())
                ->with('chart_accounts', $chart_accounts);

        }
        elseif ($settings_page == 'تعين حسابات الاهلاك')
        {
            $chart_accounts = AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
            return view('AccountingSystem.settings.damage_setting')
                ->with('settings_page', $settings_page)
                ->with('settings', AccountingSetting::where('slug', $slug)->where('accounting_type','Acc_damages')->get())
                ->with('chart_accounts', $chart_accounts);

        }




        else{
        return view('AccountingSystem.settings.setting')

            ->with('settings_page', $settings_page)

            ->with('settings', AccountingSetting::where('slug', $slug)->get());

        }

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

//        Activity::log('زيارة لصفحة  اضافة الإعدادات');

        return view('AccountingSystem.setting');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
        $requests=$request->except('accounts');
        $this->RegisterSetting($requests);
        if (isset($request['accounts'])) {
            foreach ($request['accounts'] as $key => $value) {
                $account = AccountingAccount::find($key);
                $account->update([
                    'code' => $value
                ]);
            }
        }
        alert()->success('تم حفظ الاعدادات بنجاح !')->autoclose(5000);

        return redirect()->back();



    }

    public  function backup(){

      try {
            // start the backup process
//            Artisan::call('backup:run --only-db');
//            Artisan::call('backup:run',['--only-db'=>true]);
            Artisan::call('backup:run',['--only-db'=>true]);

            $output = Artisan::output();

            // log the results
//            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call

            alert()->success('تم نسخ بيانات البرنامج  بنجاح !')->autoclose(5000);

//          return  response()->download('')->deleteFileAfterSend(true);











        } catch (\Exception $e) {
            dd($e->getMessage());
            alert()->error('لم يتم نسخ بيانات البرنامج  حاول  مره اخرى !')->autoclose(5000);

            return redirect()->back();
        }

    }



}
