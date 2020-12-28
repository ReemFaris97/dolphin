<?php

namespace App\Http\Controllers\Api;

use App\Events\ChargeCreated;
use App\Events\ChargeReceived;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChargesResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\LogsResource;
use App\Http\Resources\NotesResource;
use App\Http\Resources\SingleChargeResource;
use App\Http\Resources\SingleLogResource;
use App\Http\Resources\UserResource;
use App\Models\Charge;
use App\Models\Clause;
use App\Models\NotificationCategory;
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


class ChargeController extends Controller
{
    use ApiResponses,ChargeOperation;


    public function index(){

        if (\request('status') == "received")
            $charges = Charge::
            whereNull('destroyed_at')
                ->whereNotNull('confirmed_at')
                ->where('supervisor_id',auth()->user()->id)
                ->orderby('id','desc')->paginate($this->paginateNumber);
            else
                $charges = Charge::
                whereNull('destroyed_at')
                    ->whereNull('confirmed_at')
                    ->where('supervisor_id',auth()->user()->id)
                    ->orderby('id','desc')->paginate($this->paginateNumber);
        return $this->apiResponse(new ChargesResource($charges));
    }


    public function assignedCharges()
    {
        $charges = Charge::
        whereNull('destroyed_at')
            ->whereNotNull('confirmed_at')
            ->where('worker_id',auth()->user()->id)
            ->orderby('id','desc')->paginate($this->paginateNumber);
        return $this->apiResponse(new ChargesResource($charges));
    }


    public function store(Request $request){
      $request['supervisor_id'] = auth()->user()->id;
        $rules = [
            'name' => 'required|string|max:191',
            'description' => 'required|string',
            'worker_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'images' => 'required|array',
             'images.*' =>'required|mimes:jpg,jpeg,gif,png',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $charge = $this->RegisterCharge($request);
//        event(new ChargeCreated($charge->worker,$charge));
        return $this->apiResponse(new SingleChargeResource($charge));
    }

    public function update(Request $request,$id){

      $charge = Charge::find($id);
      if (!$charge) return $this->notFoundResponse();
        $rules = [
            'name' => 'required|string|max:191',
            'description' => 'required|string',
            'worker_id' => 'required|exists:users,id',
            'images' => 'sometimes|array',
             'images.*' =>'sometimes|mimes:jpg,jpeg,gif,png',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $this->UpdateCharge($charge,$request);
        return $this->apiResponse(new SingleChargeResource($charge));
    }

    public function addLog(Request $request,$id)
    {
        $charge = Charge::find($id);
        if (!$charge) return $this->notFoundResponse();

        $rules = [
            'worker_id' => 'required|exists:users,id',
            'type' => 'required|string|in:transfer,receive',
            'images' => 'sometimes|array',
            'images.*' =>'sometimes|mimes:jpg,jpeg,gif,png',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $log = $this->AddChargeLog($request,$charge);
        return $this->apiResponse(new SingleLogResource($log));
    }

    public function addNotes(Request $request,$id)
    {
        $charge = Charge::find($id);
        if (!$charge) return $this->notFoundResponse();
        $rules = [
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' =>'required|mimes:jpg,jpeg,gif,png',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $this->AddChargeNotes($request,$charge);
        return $this->apiResponse('تم اضافة ملاحظه جديد');
    }

    public function destroy($id)
    {
        $charge = Charge::find($id);
        if (!$charge) return $this->notFoundResponse();

        $charge->markAsDestroyed();
        return $this->apiResponse('تم الاتلاف بنجاح');
    }

    public function confirmCharge(Request$request,$id)
    {
        $rules = [
            'code' => 'required|integer|exists:charges,code',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        /** @var Charge $charge */
        $charge = Charge::whereIdAndSupervisorId($id,auth()->user()->id)->whereCode($request->code)->first();
        if (!$charge) return $this->notFoundResponse();
//        event(new ChargeReceived($charge->worker,$charge));
        $charge->markAsConfirmed();
        return $this->apiResponse('تم التفعيل بنجاح');
    }

    public function getNotes($id)
    {
        $charge = Charge::find($id);
        if (!$charge) return $this->notFoundResponse();

        $notes = $charge->notes;
        return $this->apiResponse(new NotesResource($this->CollectionPaginate($notes)));
    }

    public function getLogs($id)
    {
        $charge = Charge::whereId($id)->where('supervisor_id',auth()->user()->id)->first();
        $logs = $charge->logs;
        return $this->apiResponse(new LogsResource($this->CollectionPaginate($logs)));
    }

    public function show($id)
    {
        $charge = Charge::find($id);
        if (!$charge) return $this->notFoundResponse();

        $data =[
            'name'=>$charge->name,
            'description'=>$charge->description,
            'images'=>ImageResource::collection($charge->images)
            ];
        return $this->apiResponse($data);
    }

}
