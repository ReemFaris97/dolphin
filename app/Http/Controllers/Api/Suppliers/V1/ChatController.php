<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\MessageResource;
use App\Models\Chat\Chat;
use App\Models\Supplier\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = auth()->user();
        $chat = Chat::firstOrCreate(['accounting_supplier_id' => $user->supplier_id, 'accounting_company_id' => request()->header('X-company-id')]);

        $messages = $chat->messages()->latest()->paginate(request('limit', 10));
        return \responder::success(new BaseCollection($messages, MessageResource::class, ['chat_id' => $chat->id]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Chat $chat)
    {
        $inputs = $request->validate([
            'message' => 'required|string',
            'attachment' => 'sometimes|nullable|file',
            'type' => 'in:voice,image,video|required_with:attachment',
            'thumbnail' => 'sometimes|nullable|required_if:type,video'
        ]);
        $inputs['user_type'] = User::class;
        $inputs['user_id'] = auth()->id();
        $message = $chat->messages()->create($inputs);
        activity()
            ->causedBy(auth()->user())
            ->log(sprintf('قام %s ب %s',auth()->user()->name,"بإرسال رسالة ||  {$message->message}"));
        return \responder::success(new MessageResource($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
