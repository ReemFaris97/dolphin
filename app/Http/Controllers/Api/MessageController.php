<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\InboxResource;
use App\Http\Resources\MessagesResource;
use App\Traits\ApiResponses;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Events\PrivateMessageSent;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Pusher\Pusher;

class MessageController extends Controller
{

    use ApiResponses;

    public function Inbox()
    {
        $messages_recievers_id = Message::where('user_id',auth()->user()->id)->pluck('receiver_id');
        $messages_user_id = Message::where('receiver_id',auth()->user()->id)->pluck('user_id');
        $ids = $messages_recievers_id->merge($messages_user_id);
        $users = User::whereIn('id',$ids)->paginate($this->paginateNumber);
        return $this->apiResponse(new InboxResource($users));
    }

    public function Messages($user_id)
    {
//        $chat_messages= Message::with('user')
//            ->where(['user_id'=> auth()->user()->id, 'receiver_id'=> $user_id])
//            ->orWhere(function($query) use($user_id){
//                $query->where(['user_id' => $user_id, 'receiver_id' => auth()->user()->id]);
//            })->count();
//
//        $pagniation = $this->paginateNumber;
//
//        if ($chat_messages != 0)
//        {
//            $page_numbers = $this->paginateNumber % 2;
//            if ($page_numbers != 0)
//            {
//                $pagniation+=$page_numbers ;
//            }
//        }

        $privateCommunication= Message::with('user')
            ->where(['user_id'=> auth()->user()->id, 'receiver_id'=> $user_id])
            ->orWhere(function($query) use($user_id){
                $query->where(['user_id' => $user_id, 'receiver_id' => auth()->user()->id]);
            })->orderByDesc('id')->paginate($this->paginateNumber);

        return $this->apiResponse(new MessagesResource($privateCommunication));
    }



    public function sendMessage(Request $request,$user_id)
    {
        $rules = [
            'message'   =>'sometimes|string',
            'image' =>'sometimes',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        if(request()->has('image')){
            $filename = uploader($request, 'image');
            $message=Message::create([
                'user_id' => auth()->user()->id,
                'image' => $filename,
                'receiver_id' => $user_id
            ]);
        }else{
            $input=$request->all();
            $input['receiver_id']=$user_id;
            $message=auth()->user()->messages()->create($input);
        }

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '176213519fdc053e25ec',
            'd2cc4867140888d7698f',
            '791292',
            $options
        );

        $q=$message;
        $data = [
            'id'=>$q->id,
            'type'=>$q->type(),
            'image'=>getStorageImg($q->image)??"",
            'message'=>$q->message??"",
            'created_at'=>date('Y-m-d',strtotime($q->created_at)),
            'user'=>[
                'id'=>$q->user->id,
                'name'=>$q->user->name,
                'image'=>$q->user->name,
            ]
        ];
        $pusher->trigger('privatechat.'.$user_id, 'PrivateMessageSent', $data);

        return $this->apiResponse('تم ارسال الرسالة بنجاح');
    }

}
