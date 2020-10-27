<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/check';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    protected function credentials(Request $request)
    {

//        dd($request->all());
        if (!filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {

            return ['name' => $request->get('email'), 'password' => $request->password, 'blocked_at' => null];
        } else {

            return ['email' => $request->{$this->username()}, 'password' => $request->password, 'blocked_at' => null];
            /*        return $request->only($this->username(), 'password');*/
        }
    }


    public function logout(Request $request)
    {
//        auth()->user()->update([
//            'enable'=>1
//        ]);
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('admin.login');
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
