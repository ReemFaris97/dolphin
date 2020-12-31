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
        $messages_recievers_id = Message::where('user_id',auth()->user()->id)->pluck('receiver_id','created_at');
        $messages_user_id = Message::where('receiver_id',auth()->user()->id)->pluck('user_id','created_at');
        $ids = $messages_recievers_id->merge($messages_user_id)->sortBy('created_at')->toArray();
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
                'receiver_id' => $user_id,
                'channel_id' => auth()->user()->id.'_'.$user_id,
            ]);
        }else{
            $input=$request->all();
            $input['receiver_id']=$user_id;

//            $channel_name=Message::where('channel_id',auth()->user()->id.'_'.$receiver_id)
//                ->orWhere('channel_id',$receiver_id.'_'.auth()->user()->id)->first();
//            if ($channel_name){
//                $input['channel_id']= $channel_name->channel_id;
//            }else{
//                $input['channel_id'] = auth()->user()->id . '_' . $receiver_id;
//            }
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
        $users=[intval($user_id),auth()->user()->id];
        sort($users);
        $channel=$users[0]."_".$users[1];
        $pusher->trigger('privatechat.'.$channel, 'PrivateMessageSent', $data);
//        dd($pusher);
        return $this->apiResponse('تم ارسال الرسالة بنجاح');
    }

}
