<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChargesResource;
use App\Http\Resources\ClausesResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\LogsResource;
use App\Http\Resources\NotesResource;
use App\Http\Resources\SingleChargeResource;
use App\Http\Resources\UserResource;
use App\Models\Charge;
use App\Models\Clause;
use App\Traits\ApiResponses;
use App\Traits\ChargeOperation;
use App\Traits\ClauseOperation;
use App\Traits\UserOperation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use JWTFactory;
use JWTAuth;
use Validator;
use Illuminate\Http\Response;


class ClauseController extends Controller
{
    use ApiResponses,ClauseOperation;


    public function index(){

        $clauses = Clause::where('user_id',auth()->user()->id)->get();
        return $this->apiResponse(ClausesResource::collection($clauses));
    }

    public function store(Request $request){
        $request['clauses'] = json_decode($request->clauses,TRUE);
        $rules = [
//            'clauses' => 'required|array',
//            'clauses.*' =>'required|integer|exists:clauses,id',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
       $result= $this->AddClauseLogWithJson($request);
        if ($result) return $this->apiResponse('تم ادخال الارقام بنجاح');
        return $this->apiResponse('عذراً هناك بعض الارقام الغير مفعله');
    }

}
