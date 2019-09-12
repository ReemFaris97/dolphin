<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\SupplierLogsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Models\SupplierLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Response;
use App\Traits\UserOperation;

class EmployeesController extends Controller
{
    use ApiResponses, UserOperation;
    public function index(){
         $employees = User::where('is_supplier',1)->where('parent_user_id','!=',null)->paginate($this->paginateNumber);
        return $this->apiResponse(new UsersResource($employees));
    }

    public function getLog($id){
        $logs = SupplierLog::where('user_id',$id)->paginate($this->paginateNumber);
        return $this->apiResponse(new SupplierLogsResource($logs));
    }

    public function store(Request $request){

        $rules = [
            'name' =>'required|string|max:191',
            'phone'      =>'required|string|unique:users',
            'email'      =>'nullable|email|max:191|unique:users',
            'password'   =>'required|string|confirmed|max:191',
            'permissions'=>'required|array',
            'permissions.*'=>'numeric|exists:permissions,id',
        ];

        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $user = $this->RegisterSupplierEmployee($request);
        return $this->apiResponse(new UserResource($user));

    }

    public function update(Request $request,$id){

    }
}
