<?php


namespace App\Traits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

trait ApiResponses
{
    public $paginateNumber = 10;

    public function apiResponse($data = null , $error = null ,$code = 200){

        if ($error != null) {
            $array = [
                'value' => in_array($code, $this->successCode()) ? true : false,
                'msg' => $error,
                'comment'=>$this->FunnyComments(),
            ];
        } else {
            $array = [
                'value' => in_array($code, $this->successCode()) ? true : false,
                'data' => $data,
                'comment'=>$this->FunnyComments(),
            ];
        }
        return response($array, 200);
    }

    public function successCode(){
        return [
            200 , 201 , 202
        ];
    }

    public function createdResponse($data){
        return $this->apiResponse($data, null, 201);
    }

    public function deleteResponse(){
        return $this->apiResponse(true, null, 200);
    }

    public function notFoundResponse(){
        return $this->apiResponse(null, __('messages.not_found'), 404);
    }

    public function unKnowError(){
        return $this->apiResponse(null, 'Un know error', 520);
    }

    public function userSuspend($msg){

        $array = [
            'value' =>false,
            'msg' => $msg,
            'comment'=>$this->FunnyComments(),
        ];
  return response($array, 420);
    }

    public function apiValidation($request, $array){

        $validate = Validator::make($request->all() , $array);

        $errors = [];

        if($validate->fails()){
            foreach($validate->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
                return $this->apiResponse(null, $errors[$key], 422);
                break;
            }
        }

    }

    /**
     * @param $items
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function CollectionPaginate($items, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $this->paginateNumber), $items->count(), $this->paginateNumber, $page, $options);
    }

    public function FunnyComments()
    {
        $arr=array(
          'لو شفت الرساله دي معناها ان الباك اند زي الفل واي مشكله مش تبعي ',
            'انا عاوز بوست مان زي بتاعه أبوالنجا -اقوال مأثورة -   ',
            'اتنين ملهمش امان الصاحب والبوست مان',
            'كنت عصفور كلونى عملت اسد صاحبونى ',
            'الكار دا مش كارنا بس ربنا يصبرنا ',
            'رميت همومي في البحر طلغ السمك يلطم ',
            'حتى هدف حياتي ، طلع تسلل    ',
            '·لو صاحبك خانك اعتبره دخانك',
            '·أخرة الشقاوة عيش وحلاوة',
            'صاحب صاحبك على عيبه ومتصاحبش اللى فى جيبه',
            'مفيش فايدة',
            'الباشا من هيبته بيتشتم في غيبته .',
            ' واحد اتجوز واحدة اسمها نعمة باسها وش و ضهر.',
            ' مرة واحد عداه العيب خد اللي بعده.',
            ' مرة أتنين صحاب راحوا للحلاق واحد حلق والتاني غويشه.',
            ' فرخة استحمت بهد اند شولدر باضت بيضة من غير قشره.',
        );

        $winner = array_rand($arr, 1);
        $winner_name = strtoupper($arr[$winner]);
        return $winner_name;
    }
}
