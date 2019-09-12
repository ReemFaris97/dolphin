<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
class EmployeesController extends Controller
{
    use ApiResponses;
    public function index(){
         $employees = User::where('is_supplier',1)->where('parent_user_id','!=',null)->paginate($this->paginateNumber);
        return $this->apiResponse(new UsersResource($employees));
    }

    public function getLog($id){

    }

    public function store(Request $request){

    }

    public function update(Request $request,$id){

    }
}
