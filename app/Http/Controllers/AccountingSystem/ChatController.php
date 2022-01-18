<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\MessageResource;
use App\Models\Chat\Chat;
use App\Models\Supplier\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AccountingSystem.chats.index')->with('chats', Chat::latest('updated_at')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Chat $chat)
    {
        if (request()->ajax()) {
            return response()->json(['messages'=>MessageResource::collection($chat->messages()->limit(500)->latest()->get())]);
        }
        return view('AccountingSystem.chats.show', ['chat' => $chat]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Chat $chat)
    {
        $inputs = $request->validate([
            'message' => 'required|string',
            'attachment' => 'sometimes|nullable|file',
            'type' => 'in:voice,image,video,message|required_with:attachment',

        ]);
        $inputs['user_type'] = \App\Models\User::class;
        $inputs['user_id'] = auth()->id();
        $message = $chat->messages()->create($inputs);

        return \responder::success(['text'=>'تم الارسال بنجاح !','message'=>new \App\Http\Resources\Suppliers\MessageResource($message)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
