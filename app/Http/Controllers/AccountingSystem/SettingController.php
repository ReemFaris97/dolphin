<?php


namespace App\Http\Controllers\AccountingSystem;



use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSetting;
use App\Traits\SettingOperation;
use App\Setting;
use Artisan;
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
        $settings = AccountingSetting::groupBy('page')->distinct()->get();

        return view('AccountingSystem.settings.index',compact('settings'));

    }



    public function show($slug)

    {
       // dd("ddd");

        $settings = AccountingSetting::where('slug', $slug)->get();

        if (!$settings)


            return redirect('/accounting/settings');

        $settings_page = $settings->pluck('page')->first();

        return view('AccountingSystem.settings.setting')

            ->with('settings_page', $settings_page)

            ->with('settings', $settings);

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

        $this->RegisterSetting($request);

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

          return redirect()->back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            alert()->error('لم يتم نسخ بيانات البرنامج  حاول  مره اخرى !')->autoclose(5000);

            return redirect()->back();
        }

    }



}
