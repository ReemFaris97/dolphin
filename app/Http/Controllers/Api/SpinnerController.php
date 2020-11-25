<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChargesResource;
use App\Http\Resources\GeneralModelResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\SingleChargeResource;
use App\Http\Resources\SpinnerClausesResource;
use App\Http\Resources\UserResource;
use App\Models\Charge;
use App\Models\Clause;
use App\Models\Notification;
use App\Models\NotificationCategory;
use App\Models\Task;
use App\Traits\ApiResponses;
use App\Traits\ChargeOperation;
use App\Traits\UserOperation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use JWTFactory;
use JWTAuth;
use Validator;
use Illuminate\Http\Response;


class SpinnerController extends Controller
{
    use ApiResponses;


    /**
     * Return List of Workers
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllWorkers(){
        $workers = User::all();
        return $this->apiResponse(GeneralModelResource::collection($workers));
    }


    /**
     * Return List of Notifications Categories
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllNotificationsCategories(){
        $categories = NotificationCategory::all();
        return $this->apiResponse(GeneralModelResource::collection($categories));
    }


    /**
     * Return List of Tasks
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllTasks(){
        if (\request('worker_id')!="")
        {
            $tasks_ids = User::find(\request('worker_id'))->tasks->pluck('task_id');
            $tasks = Task::whereIn('id',$tasks_ids)->get();
        }
        elseif (\request('current') != "")
        {
            $tasks =  Task::present()->get();
        }
        else{
            $tasks = Task::get();
        }
        return $this->apiResponse(GeneralModelResource::collection($tasks));
    }

    /**
     * Return List of Tasks
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllClauses(){
        $tasks = Clause::get();
        return $this->apiResponse(SpinnerClausesResource::collection($tasks));
    }

}
