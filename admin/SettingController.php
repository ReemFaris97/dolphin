<?php



namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Traits\SettingOperation;
use App\Setting;

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
        $settings = Setting::groupBy('page')->distinct()->get();

        return view('admin.settings.index',compact('settings'));

    }



    public function show($slug)

    {
       // dd("ddd");

        $settings = Setting::where('slug', $slug)->get();

        if (!$settings)

            return redirect('/dashboard');

        $settings_page = $settings->pluck('page')->first();

        return view('admin.settings.setting')

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

        return view('admin.setting');

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



}