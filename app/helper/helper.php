<?php


//Json array response
use Carbon\Carbon;

function responseJson($status, $msg, $data = null, $state = 200)
{
    $response = [
        'status' => (int)$status,
        'message' => $msg,
        'data' => $data,
    ];
    return response()->json($response, $state);
}

function rearrange_array($array, $key) {
    while ($key > 0) {
        $temp = array_shift($array);
        $array[] = $temp;
        $key--;
    }
    return $array;
}


function storekeepers()
{
    $storekeepers = \App\User::where('is_storekeeper',1)->get()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $storekeepers;
}

function allstores()
{
    $stores = \App\Models\AccountingSystem\AccountingStore::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
    return $stores;
}


function stores_to($id=Null)

{
    if ($id != null) {
    $stores_to= \App\Models\AccountingSystem\AccountingStore::where('id','!=',$id)->get()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
}else{
    $stores_to=[];
}

    // dd($stores_to);
    return $stores_to;
}

function products($store=null){
    if ($store != null) {

        $products_id=App\Models\AccountingSystem\AccountingProductStore::where('store_id',$store)->where('quantity','!=',Null)->where('quantity','>',0)->pluck('product_id')->toArray();

          $products=App\Models\AccountingSystem\AccountingProduct::whereIn('id',$products_id)->get()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });


    }else{
        $products=[];
    }

    return $products;
}

function products_purchase($purchase=null){
    if ($purchase != null) {

        $products_id=App\Models\AccountingSystem\AccountingPurchaseItem::where('purchase_id',$purchase)->where('quantity','!=',Null)->pluck('product_id')->toArray();

          $products=App\Models\AccountingSystem\AccountingProduct::whereIn('id',$products_id)->get()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });


    }else{
        $products=[];
    }

    return $products;
}






function getsetting($name)
{
    $settings=App\Models\AccountingSystem\AccountingSetting::where('name',$name)->first();
//    dd($settings);
    return $settings->value ??'';
}

function products_not_settement($store=null){
    if ($store != null) {

        $products_id=App\Models\AccountingSystem\AccountingProductStore::where('store_id',$store)->where('quantity','!=',Null)->where('quantity','>',0)->pluck('product_id')->toArray();

        $products=App\Models\AccountingSystem\AccountingProduct::select(['id', 'name'])->whereIn('id',$products_id)->where('is_settlement',0)->get();


    }else{
        $products=[];
    }


    return $products;
}


function companies()
{
    $companies = \App\Models\AccountingSystem\AccountingCompany::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $companies;
}


function shifts()
{
    $shifts = \App\Models\AccountingSystem\AccountingBranchShift::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['name']];
    });
    return $shifts;
}

function devices()
{
    $devices = \App\Models\AccountingSystem\AccountingDevice::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['code']];
    });
// dd($devices);
    return $devices;
}





function keepers($store= null)
{
    if ($store != null) {
        $keepers = \App\User::where('is_storekeeper', 1)->where('accounting_store_id',$store)->get()->mapWithKeys(function ($q) {
            return [$q['id'] => $q['name']];
        });
    }else{
        $keepers=[];
    }

    return $keepers;
}

function AllStore()
{
    $stores =App\Models\AccountingSystem\AccountingStore::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
// dd($devices);
    return $stores;
}

function branches($company = null)
{

    if ($company != null) {
        $branches = App\Models\AccountingSystem\AccountingCompany::find($company)->branches->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name'],'all' => 'كل الفروع'];
        });
    } else {
        $branches = \App\Models\AccountingSystem\AccountingBranch::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }
    return $branches;
}



function branches_only($company = null)
{

    if ($company != null) {
        $branches = App\Models\AccountingSystem\AccountingCompany::find($company)->branches->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    } else {
        $branches = \App\Models\AccountingSystem\AccountingBranch::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }
    return $branches;
}


function stores($branch=null){


    if ($branch != null) {

        dd('wewer');
        // $stores=App\Models\AccountingSystem\AccountingStore::find($branch)->faces->mapWithKeys(function ($item) {
        //     return [$item['id'] => $item['ar_name']];
        // });
    }else{
    $stores=[];
}
    return $stores;
}


function faces($branch=null,$company_id=null){
    if ($branch != null) {
        if ($branch != 'all') {
        $faces=App\Models\AccountingSystem\AccountingBranch::find($branch)->faces->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        }else{
            $branches=App\Models\AccountingSystem\AccountingBranch::where('company_id',$company_id)->get();
            $faces=[];
            foreach ($branches as $branch) {
               $face=$branch->faces->mapWithKeys(function ($item) {
                      return [$item['id'] => $item['name']];
                  });
                }
              array_push($faces,$face);
            dd($faces);
        }

    }else{
        $faces=[];
    }

    return $faces;
}



function colums($face=null,$cell=null){
    if ($face != null) {


        $colums=App\Models\AccountingSystem\AccountingBranchFace::find($face)->columns->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }else{
        $colums=[];
    }
    if($cell!= null){
        dd($cell->column_id);
       return $cell->column_id;
    }

    return $colums;
}

function cells($colum=null){
    if ($colum != null) {


        $cells=App\Models\AccountingSystem\AccountingFaceColumn::find($colum)->cells->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
    }else{
        $cells=[];
    }

    return $cells;
}


function saveImage($file, $folder = '/')
{
    $fileName = date('YmdHis') . '-' . $file->getClientOriginalName();;
    $path = \Storage::disk('public')->putFileAs($folder, $file, $fileName);
    return 'storage/' . $path;
}


function uploadpath()
{
    return 'photos';
}

function uploader($request, $img_name)

{
    $file = $request->file($img_name);
    $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
    $fileName = $fileHash . '.' . $request->file($img_name)->getClientOriginalExtension();
    $path = Storage::disk('public')->putFileAs(uploadpath(), $file, $fileName);
    return $path;
}


function routeActive($path, $active = 'active')
{

    return request()->routeIs($path) ? $active : '';
}

function urlActive($path, $active = 'active')
{
    return Request::is($path . '*') ? $active : '';
}


/**
 * Get Image
 * @param $filename
 * @return string
 */
//function getimg($filename)
//{
//    $base_url = url('/');
//    return $base_url . '/' . $filename;
//}

function getimg($filename)
{
    $base_url = url('/');
    return $base_url.'/'.$filename;
}


function deleteImg($img_name)
{
    \Storage::disk('public')->delete(uploadpath(),$img_name);
    return True;
}



/**
 * Get Image
 * @param $filename
 * @return string
 */
function getStorageImg($filename)
{
    $base_url = url('/');
    return $base_url . '/storage/' . $filename;
}

function getimgWeb($filename)
{
    $base_url = url('/');
    return $base_url . '/' . $filename;
}

function generatePIN($digits = 4)
{
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

function ShowOrHide($task, $types)
{

    if (in_array($task->type, $types)) {

        return 'd-block';
    }
    return 'd-none';

}

function toSeconds($days, $hours, $minutes)
{

    $seconds = 0;
    $seconds += (($days * 24 + $hours) * 60 + $minutes) * 60;
    /*    return strtotime("{$days} days {$hours} hours {$minutes} minutes");*/

    return $seconds;
}

function secondsToTime($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    $days = $dtF->diff($dtT)->format('%a');
    $hours = $dtF->diff($dtT)->format('%h');
    $minutes = $dtF->diff($dtT)->format('%i');
    return ['days' => $days, 'hours' => $hours, 'minutes' => $minutes];
}


function taskTypes()
{

}

function presentFilter($task_user)
{
    if($task_user->from_time==null){
        return false;
    };
    return (Carbon::now()->greaterThanOrEqualTo($task_user->from_time) && Carbon::now()->LessThanOrEqualTo($task_user->to_time));
}

function oldFilter($task_user)
{
    if($task_user->from_time==null){
        return false;
    };
    return (Carbon::now()->greaterThan($task_user->from_time) && Carbon::now()->greaterThan($task_user->to_time));
}
function futureFilter($task_user)
{

    if($task_user->from_time==null){
        return false;
    };

    return (Carbon::now()->lessThan($task_user->from_time) && Carbon::now()->lessThan($task_user->to_time));

}


function rates()
{
    $arr = [
        '0'=>'سئ',
        '1'=>'ضعيف',
        '2'=>'مقبول',
        '3'=>'جيد',
        '4'=>'جيد جداً',
        '5'=>'مثالي',
    ];
    return $arr;
}

function idol_user()
{
    $idol_user = \App\User::WhereHas('tasks',function ($q){
        $q->where('rate','!=',null);
        $q->whereMonth('finished_at',date("m"));
    })->get()->sortByDesc(function($user) {
        return $user->rate();
    })->first();

    return $idol_user;
}


function lastMessage($user_id)
{
    $message_user = \App\Models\Message::where(['user_id' => auth()->user()->id, 'receiver_id' => $user_id])->orderby('id', 'desc')->first();
    $message_reciver = \App\Models\Message::where(['receiver_id' => auth()->user()->id, 'user_id' => $user_id])->orderby('id', 'desc')->first();
    if ($message_user && $message_reciver) {
        if ($message_reciver->created_at > $message_user->created_at) return $message_reciver->message;
        return $message_user->message;
    } elseif ($message_user) return $message_user->message;
    elseif ($message_reciver) return $message_reciver->message;
    return 'لا يوجد رسائل';
}


function allowExtentionsImage()
{
    return [
        'png',
        'jpg',
        'jpeg',
        'gif',
        'IMG'
    ];
}

function allowExtentionsFiles()
{
    return [
        'txt',
        'zip',
        'sql',
        'xls',
        'xlm',
        'xla',
        'xlc',
        'xlt',
        'xlw',
        'pdf',
        'xla',
        'docx',
        'rtf',
        'doc',
        'dot',
        'dotx',
        'docm',
        'xlsx',
        'xlsm',
        'xltx',
        'dotm',
        'xltm',
        'xlam',
        'xlsb'
    ];
}

function getFileType($filedName, $value)
{
        if (in_array(getExtention($value), allowExtentionsImage())) {
            return 'Image';
        }
        if (in_array(getExtention($value), allowExtentionsFiles())) {
            return 'File';
        }
        else
            return "undefined";
}

function getExtention($fileName)
{
    $array = explode('.', $fileName);
    return end($array);
}


function getNationalities(){

    return [
        "Afghan"=> "أفغاني",
        "Albanian"=> "ألباني",
        "Algerian"=> "جزائري",
        "American"=> "أمريكي",
        "Andorran"=> "أندوري",
        "Angolan"=> "أنغولي",
        "Antiguans"=> "انتيغوا",
        "Argentinean"=> "أرجنتيني",
        "Armenian"=> "أرميني",
        "Australian"=> "أسترالي",
        "Austrian"=> "نمساوي",
        "Azerbaijani"=> "أذربيجاني",
        "Bahamian"=> "باهامى",
        "Bahraini"=> "بحريني",
        "Bangladeshi"=> "بنجلاديشي",
        "Barbadian"=> "باربادوسي",
        "Barbudans"=> "بربودا",
        "Batswana"=> "بوتسواني",
        "Belarusian"=> "بيلاروسي",
        "Belgian"=> "بلجيكي",
        "Belizean"=> "بليزي",
        "Beninese"=> "بنيني",
        "Bhutanese"=> "بوتاني",
        "Bolivian"=> "بوليفي",
        "Bosnian"=> "بوسني",
        "Brazilian"=> "برازيلي",
        "British"=> "بريطاني",
        "Bruneian"=> "بروناى",
        "Bulgarian"=> "بلغاري",
        "Burkinabe"=> "بوركيني",
        "Burmese"=> "بورمي",
        "Burundian"=> "بوروندي",
        "Cambodian"=> "كمبودي",
        "Cameroonian"=> "كاميروني",
        "Canadian"=> "كندي",
        "Cape Verdean"=> "االرأس الأخضر",
        "Central African"=> "وسط أفريقيا",
        "Chadian"=> "تشادي",
        "Chilean"=> "شيلي",
        "Chinese"=> "صينى",
        "Colombian"=> "كولومبي",
        "Comoran"=> "جزر القمر",
        "Congolese"=> "كونغولي",
        "Costa Rican"=> "كوستاريكي",
        "Croatian"=> "كرواتية",
        "Cuban"=> "كوبي",
        "Cypriot"=> "قبرصي",
        "Czech"=> "تشيكي",
        "Danish"=> "دانماركي",
        "Djibouti"=> "جيبوتي",
        "Dominican"=> "دومينيكاني",
        "Dutch"=> "هولندي",
        "East Timorese"=> "تيموري شرقي",
        "Ecuadorean"=> "اكوادوري",
        "Egyptian"=> "مصري",
        "Emirian"=> "إماراتي",
        "Equatorial Guinean"=> "غيني  استوائي",
        "Eritrean"=> "إريتري",
        "Estonian"=> "إستوني",
        "Ethiopian"=> "حبشي",
        "Fijian"=> "فيجي",
        "Filipino"=> "فلبيني",
        "Finnish"=> "فنلندي",
        "French"=> "فرنسي",
        "Gabonese"=> "جابوني",
        "Gambian"=> "غامبيي",
        "Georgian"=> "جورجي",
        "German"=> "ألماني",
        "Ghanaian"=> "غاني",
        "Greek"=> "إغريقي",
        "Grenadian"=> "جرينادي",
        "Guatemalan"=> "غواتيمالي",
        "Guinea-Bissauan"=> "غيني بيساوي",
        "Guinean"=> "غيني",
        "Guyanese"=> "جوياني",
        "Haitian"=> "هايتي",
        "Herzegovinian"=> "هرسكي",
        "Honduran"=> "هندوراسي",
        "Hungarian"=> "هنغاري",
        "Icelander"=> "إيسلندي",
        "Indian"=> "هندي",
        "Indonesian"=> "إندونيسي",
        "Iranian"=> "إيراني",
        "Iraqi"=> "عراقي",
        "Irish"=> "إيرلندي",
        "Italian"=> "إيطالي",
        "Ivorian"=> "إفواري",
        "Jamaican"=> "جامايكي",
        "Japanese"=> "ياباني",
        "Jordanian"=> "أردني",
        "Kazakhstani"=> "كازاخستاني",
        "Kenyan"=> "كيني",
        "Kittian and Nevisian"=> "كيتياني ونيفيسياني",
        "Kuwaiti"=> "كويتي",
        "Kyrgyz"=> "قيرغيزستان",
        "Laotian"=> "لاوسي",
        "Latvian"=> "لاتفي",
        "Lebanese"=> "لبناني",
        "Liberian"=> "ليبيري",
        "Libyan"=> "ليبي",
        "Liechtensteiner"=> "ليختنشتايني",
        "Lithuanian"=> "لتواني",
        "Luxembourger"=> "لكسمبرغي",
        "Macedonian"=> "مقدوني",
        "Malagasy"=> "مدغشقري",
        "Malawian"=> "مالاوى",
        "Malaysian"=> "ماليزي",
        "Maldivan"=> "مالديفي",
        "Malian"=> "مالي",
        "Maltese"=> "مالطي",
        "Marshallese"=> "مارشالي",
        "Mauritanian"=> "موريتاني",
        "Mauritian"=> "موريشيوسي",
        "Mexican"=> "مكسيكي",
        "Micronesian"=> "ميكرونيزي",
        "Moldovan"=> "مولدوفي",
        "Monacan"=> "موناكو",
        "Mongolian"=> "منغولي",
        "Moroccan"=> "مغربي",
        "Mosotho"=> "ليسوتو",
        "Motswana"=> "لتسواني",
        "Mozambican"=> "موزمبيقي",
        "Namibian"=> "ناميبي",
        "Nauruan"=> "ناورو",
        "Nepalese"=> "نيبالي",
        "New Zealander"=> "نيوزيلندي",
        "Ni-Vanuatu"=> "ني فانواتي",
        "Nicaraguan"=> "نيكاراغوا",
        "Nigerien"=> "نيجري",
        "North Korean"=> "كوري شمالي",
        "Northern Irish"=> "إيرلندي شمالي",
        "Norwegian"=> "نرويجي",
        "Omani"=> "عماني",
        "Pakistani"=> "باكستاني",
        "Palauan"=> "بالاوي",
        "Palestinian"=> "فلسطيني",
        "Panamanian"=> "بنمي",
        "Papua New Guinean"=> "بابوا غينيا الجديدة",
        "Paraguayan"=> "باراغواياني",
        "Peruvian"=> "بيروفي",
        "Polish"=> "بولندي",
        "Portuguese"=> "برتغالي",
        "Qatari"=> "قطري",
        "Romanian"=> "روماني",
        "Russian"=> "روسي",
        "Rwandan"=> "رواندي",
        "Saint Lucian"=> "لوسياني",
        "Salvadoran"=> "سلفادوري",
        "Samoan"=> "ساموايان",
        "San Marinese"=> "سان مارينيز",
        "Sao Tomean"=> "ساو توميان",
        "Saudi"=> "سعودي",
        "Scottish"=> "سكتلندي",
        "Senegalese"=> "سنغالي",
        "Serbian"=> "صربي",
        "Seychellois"=> "سيشلي",
        "Sierra Leonean"=> "سيرا ليوني",
        "Singaporean"=> "سنغافوري",
        "Slovakian"=> "سلوفاكي",
        "Slovenian"=> "سلوفيني",
        "Solomon Islander"=> "جزر سليمان",
        "Somali"=> "صومالي",
        "South African"=> "جنوب افريقيي",
        "South Korean"=> "كوري جنوبي",
        "Spanish"=> "إسباني",
        "Sri Lankan"=> "سري لانكي",
        "Sudanese"=> "سوداني",
        "Surinamer"=> "سورينامي",
        "Swazi"=> "سوازي",
        "Swedish"=> "سويدي",
        "Swiss"=> "سويسري",
        "Syrian"=> "سوري",
        "Taiwanese"=> "تايواني",
        "Tajik"=> "طاجيكي",
        "Tanzanian"=> "تنزاني",
        "Thai"=> "التايلاندي",
        "Togolese"=> "توغواني",
        "Tongan"=> "تونجاني",
        "Trinidadian or Tobagonian"=> "ترينيدادي أو توباغوني",
        "Tunisian"=> "تونسي",
        "Turkish"=> "تركي",
        "Tuvaluan"=> "توفالي",
        "Ugandan"=> "أوغندي",
        "Ukrainian"=> "أوكراني",
        "Uruguayan"=> "أوروجواي",
        "Uzbekistani"=> "أوزبكستاني",
        "Venezuelan"=> "فنزويلي",
        "Vietnamese"=> "فيتنامي",
        "Welsh"=> "ويلزي",
        "Yemenite"=> "يمني",
        "Zambian"=> "زامبي",
        "Zimbabwean"=> "زيمبابوي"
    ];


}

function chooseNationality($nationality){
    if(array_key_exists($nationality,getNationalities())){
        return getNationalities()[$nationality];
    }
    return $nationality;

}

function currency(){

    return [
        "rial"=> "ريال",
        "pound"=> "جنيه",

];
}


function accounts(){


    $accounts=\App\Models\AccountingSystem\AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
return $accounts;
}

function pay_type(){

    return [
        "cash"=> "نقدى",
        "agel"=> "أجل",

    ];
}

function productCategories()
{
    $categories = \App\Models\AccountingSystem\AccountingProductCategory::all()->mapWithKeys(function ($q) {
        return [$q['id'] => $q['ar_name']];
    });
    return $categories;
}
