<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Charge;
use App\Models\Clause;
use App\Models\Image;
use App\Models\Note;
use App\Models\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $data = [
            'admins' => User::whereIsAdmin(1)->get()->count(),
            'users' => User::whereIsAdmin(0)->get()->count(),

            'clauses' => Clause::all()->count(),
            'charges' => Charge::all()->count(),
            'current_tasks' => Task::present(\Auth::id())->get()->count(),
            'future_tasks' => Task::future(\Auth::id())->get()->count(),
            'finished_tasks' => Task::old(\Auth::id())->get()->count(),

        ];
        $data['tasks'] = $data['current_tasks'] + $data['future_tasks'] + $data['finished_tasks'];
        return view('admin.home', compact('data'));
    }

    public function private()
    {
        return view('admin.private');
    }

    public function users()
    {
        return User::all();
    }


    public function StoreFCMToken(Request $request)
    {
        $this->validate($request,
            ['token' => 'required|string']);
        $token = \Auth::user()->tokens()->firstOrCreate(['device' => 'desktop', 'token' => $request->token]);
        return $token;

    }


    public function deleteNote($id)
    {
        Note::destroy($id);
        toast('تم الحذف بنجاح', 'success', 'top-right');

        return back();

    }

    public function deleteImage($id)
    {
        Image::destroy($id);
        toast('تم الحذف بنجاح', 'success', 'top-right');

        return back();

    }


}
