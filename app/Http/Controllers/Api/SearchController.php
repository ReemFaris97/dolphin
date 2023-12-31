<?php

namespace App\Http\Controllers\Api;

use App\Events\ChargeCreated;
use App\Events\ChargeReceived;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargesResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\InboxResource;
use App\Http\Resources\LogsResource;
use App\Http\Resources\NotesResource;
use App\Http\Resources\SingleChargeResource;
use App\Http\Resources\SingleLogResource;
use App\Http\Resources\TasksResource;
use App\Http\Resources\UserResource;
use App\Models\Charge;
use App\Models\Clause;
use App\Models\NotificationCategory;
use App\Models\Task;
use App\Traits\ApiResponses;
use App\Traits\ChargeOperation;
use App\Traits\UserOperation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use JWTFactory;
use JWTAuth;
use Validator;
use Illuminate\Http\Response;


class SearchController extends Controller
{
    use ApiResponses;


    public function chatSearch(){
        $this->apiValidation(\request(),[
            'name'=>'required|string',
        ]);
            $users = User::where('name','Like','%'.\request('name'))
                ->orwhere('name','Like','%'.\request('name').'%')
                ->orwhere('name','Like',\request('name'))->paginate($this->paginateNumber);
        return $this->apiResponse(new InboxResource($users));
    }



    public function taskSearch(){
        $this->apiValidation(\request(),[
            'name'=>'required|string',
        ]);
        $tasks = Task::where('name','Like','%'.\request('name'))
                ->orwhere('name','Like','%'.\request('name').'%')
                ->orwhere('name','Like',\request('name'))->paginate($this->paginateNumber);
        return $this->apiResponse(new TasksResource($tasks));
    }



}
