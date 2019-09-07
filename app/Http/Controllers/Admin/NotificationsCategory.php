<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\Viewable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\NotificationCategory;
use Illuminate\Support\Facades\Auth;

class NotificationsCategory extends Controller
{
    use Viewable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $viewable = 'admin.notifications_category.';

    public function index()
    {
        if (!auth()->user()->hasPermissionTo('view_emp_notifications')) {
            return abort(401);
        }
        $notifications_category = NotificationCategory::all();

        return $this->toIndex(compact('notifications_category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('view_emp_notifications')) {
            return abort(401);
        }
        return $this->toCreate();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ["name" => "required|string|min:1|max:255"]);

        NotificationCategory::create($request->all());

        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('admin.notifications-category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo('view_emp_notifications')) {
            return abort(401);
        }
        $notify = NotificationCategory::find($id);

        return $this->toEdit(compact('notify'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notify = NotificationCategory::find($id);
        if (!$notify) {
            return abort(404);
        }

        $this->validate($request, ["name" => "required|string|min:1|max:255"]);
        $notify->update($request->all());

        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('admin.notifications-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo('view_emp_notifications')) {
            return abort(401);
        }
        NotificationCategory::destroy($id);
        toast('تم الحذف بنجاح', 'success', 'top-right');
        return back();
    }

    public function readNotifications()
    {

        Auth::user()->notifications()->update(['read_at' => Carbon::now()]);

        return response()->json(['status' => 1, 'msg' => 'done']);
    }


}
