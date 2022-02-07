<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingSession;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/check";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showLoginForm()
    {
        return view("admin.auth.login");
    }

    protected function credentials(Request $request)
    {
        //        dd($request->all());
        if (!filter_var($request->get("email"), FILTER_VALIDATE_EMAIL)) {
            return [
                "name" => $request->get("email"),
                "password" => $request->password,
                "blocked_at" => null,
            ];
        } else {
            return [
                "email" => $request->{$this->username()},
                "password" => $request->password,
                "blocked_at" => null,
            ];
            /*        return $request->only($this->username(), 'password');*/
        }
    }

    public function logout(Request $request)
    {
        \DB::beginTransaction();
        $sessions_opened = AccountingSession::whereUserId(auth()->user()->id)
            ->whereNull("end_session")
            ->get();

        foreach ($sessions_opened as $session) {
            $session->update([
                "end_session" => now(),
                "status" => "closed",
            ]);
            AccountingDevice::whereId($session->device_id)->update([
                "available" => 1,
            ]);
        }

        Cookie::queue(Cookie::forget("session"));

        $this->guard()->logout();
        $request->session()->invalidate();
        \DB::commit();
        return $this->loggedOut($request) ?: redirect()->route("admin.login");
    }

    //    protected function authenticated(Request $request, $user)
    //    {
    ////        if($user->enable==0){
    ////
    ////            $this->guard()->logout();
    ////
    ////            $request->session()->invalidate();
    ////            alert()->error(' لايمكن الدخول بهذا المستخدم ,مسجل بجهاز اخر !')->autoclose(5000);
    ////
    ////            return $this->loggedOut($request) ?: redirect()->route('admin.login');
    ////
    ////            }else{
    ////                $user->update([
    ////                    'enable'=>0
    ////                ]);
    ////            }
    ////
    ////
    //   }
}
