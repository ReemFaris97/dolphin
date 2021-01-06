<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChargesResource;
use App\Http\Resources\GeneralModelResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\SingleChargeResource;
use App\Http\Resources\SpinnerClausesResource;
use App\Http\Resources\UserResource;
use App\Models\AccountingSystem\AccountingSetting;
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
        $tasks=Task::query();
        if (\request('worker_id')!="")
        {
            $tasks_ids = User::find(\request('worker_id'))->tasks/*->where('finished_at','!=',Null)*/->pluck('task_id');

            $tasks = $tasks->whereIn('id',$tasks_ids);
        }
        if (\request('current') != "")
        {
            $tasks =  $tasks->present();
        }

        $tasks=$tasks->get();
        return $this->apiResponse(GeneralModelResource::collection($tasks));
    }

    /**
     * Return List of Tasks
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllClauses(){
        $tasks = Clause::where('blocked_at', null)->get();
        return $this->apiResponse(SpinnerClausesResource::collection($tasks));
    }


}
