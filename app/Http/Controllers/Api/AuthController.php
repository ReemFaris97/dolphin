<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponses;
use App\Traits\UserOperation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use JWTFactory;
use JWTAuth;
use Validator;
use Illuminate\Http\Response;


class AuthController extends Controller
{
    use ApiResponses,UserOperation;

    /**
     * Login with a specific user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */


    public function register(Request $request){
        $rules = [
            'name' =>'required|string|max:191',
            'phone'      =>'required|string|unique:users',
            'email'      =>'nullable|email|max:191|unique:users',
            'tax_number' =>'required|numeric',
            'lat'      =>'required|string',
            'lng'      =>'required|string',
            'bank_account_number'=>'required|numeric|unique:users',
            'password'   =>'required|string|confirmed|max:191',
            'fcm_token_android'=>'required_without:fcm_token_ios',
            'fcm_token_ios'=>'required_without:fcm_token_android',
            'supplier_type'=>'required|in:dolphin,romana',
            'bank_id'=>'required|numeric|exists:banks,id',
        ];

        $validation = $this->apiValidation($request,$rules);

        if ($validation instanceof Response) {
            return $validation;
        }

        $user =$this->RegisterUser($request);
        $token = JWTAuth::fromUser($user);
        $user['token'] = $token;
        if($user->IsSupplier()){
            $user->syncPermissions(['33','34','35','36','37','38']);
        }

        $user =  new UserResource($user);
        if ($token && $user) {return $this->createdResponse($user);}
        $this->unKnowError();
    }


    public function login(Request $request,$role=null)
    {
        $rules = [
            'phone'      =>'required|string',
            'password'   =>'required|string|max:191',
            'token'=>'required|string',
            'device'=>'required|in:ios,android'
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        if ($role == "distributor")
            $credentials = ['phone'=>$request->phone,'password'=>$request->password];
        elseif ($role == "supplier")
            $credentials = ['phone'=>$request->phone,'password'=>$request->password];
        else
            $credentials = ['phone'=>$request->phone,'password'=>$request->password];

        if (!$token = JWTAuth::attempt($credentials))
            return $this->apiResponse(null,'البيانات التي ادخلتها غير صحيحة',406);
        $user = User::where('phone',$request->phone)->first();
        if (!is_null($user->blocked_at)) return $this->apiResponse(null,'لقد تم حظر عضويتك الرجاء التواصل مع الاداره',420);
        $user->updateFcmToken($request->token,$request->device);
        $user['token'] = $token;
        $user =  new UserResource($user);
        if ($token && $user) {
            return $this->apiResponse($user);
        }
        $this->unKnowError();
    }



    /***
     * Update Profile
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function UpdateProfile(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'phone'      =>'sometimes|string|unique:users,phone,'. $user->id,
            'image' =>'sometimes|image|mimes:jpg,jpeg,gif,png',
             "name" => "sometimes|string|min:1|max:255",
            "email" => "sometimes|email|min:1|max:255|unique:users,email,".$user->id,
            "password" => "sometimes|string|max:255|confirmed",
            "nationality" => "sometimes|string",
            "job" => "sometimes|string",
            "company_name" => "sometimes|string",
            "is_admin" => "sometimes|integer|in:0,1",
            'token'=>'sometimes|string',
            'device'=>'sometimes|in:ios,android',
            'bank_id'=>'sometimes|numeric|exists:banks,id',
            'bank_account_number'=>'sometimes|numeric|unique:users,bank_account_number,'.$user->id,
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}
        $this->UpdateUserProfile($user,$request);
        if ($request->token != "") $user->updateFcmToken($request->token,$request->device);
        $token = JWTAuth::fromUser($user);
        $user['token'] = $token;
        if ($user)  return $this->apiResponse(new UserResource($user));
        return $this->unKnowError();
    }


    /**
     * Forget Password
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function forget_password(Request $request)
    {
        $rules = [
            'phone'=>'required|string',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;
            $user=User::where('phone',$request->phone)->first();
        if ($user){
            $code=1234;
//            $this->SendSMS($request->phone,$code);
            $user->save();
            $data = ['code'=>$code];
            return $this->apiResponse($data);
        }else{

            return $this->apiResponse(null,'الهاتف الذي ادخلته غير صحيح',402);
        }
    }

    /**
     * Reset A password
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function reset_password(Request $request)
    {
        $rules = [
        'reset_code'=>'required',
        'password'=>'required|confirmed',
         'phone'=>'required|string',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;
        //temporary
        $user=User::where('phone',$request['phone'])->first();
        if ($user){
            $token = JWTAuth::fromUser($user);
            $user['password'] = $request->password;
            $user->save();
            $user['token'] = $token;
            $user =  new UserResource($user);
            if ($token && $user) {return $this->apiResponse($user);}
            $this->unKnowError();
            return $this->apiResponse(__($user,null,200));
        }else{
            return $this->apiResponse(null,__('messages.error_code'),402);
        }
    }

    public function Logout()
    {
//        auth()->user()->deleteFCMToken();
        return $this->apiResponse(__('تم تسجيل الخروج بنجاح بنجاح'));
    }

    public function getNotifications()
    {
        $notifications = DatabaseNotification::where('notifiable_id',auth()->user()->id)->paginate($this->paginateNumber);
        return $this->apiResponse(new NotificationResource($notifications));
    }



    public function DeleteAllNotifications()
    {
        auth()->user()->notifications()->delete();
        return $this->apiResponse('تم الحذف بنجاح');
    }

    public function destroy($id)
    {
        $notification = DatabaseNotification::find($id);
        if (!$notification) return $this->notFoundResponse();
        $notification->delete();
        return $this->apiResponse('تم الحذف بنجاح');
    }

    public function phone_activation(Request $request){


        $rules = [
            'verification_code'=>'required'
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;

        $user=User::where('phone',auth()->user()->phone)->where('verification_code',$request['verification_code'])->first();

        if ($user){
            $user->is_verified=1;
            $user->verification_code=1234;
            $user->save();
            return $this->apiResponse("الكود صحيح ..");
        }else{
            return $this->apiResponse('',"الكود خطأ .. ",'402');
        }
    }

}
