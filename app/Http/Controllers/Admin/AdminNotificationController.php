<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\FirebasOperation;
use App\Models\AdminNotification;
use App\Models\Notification;
use App\Traits\Viewable;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    use Viewable, FirebasOperation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $viewable = "admin.admin_notifications.";

    public function index()
    {
        if (
            !auth()
                ->user()
                ->hasPermissionTo("view_emp_notifications")
        ) {
            return abort(401);
        }
        $admin_notifications = AdminNotification::all();
        return $this->toIndex(compact("admin_notifications"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (
            !auth()
                ->user()
                ->hasPermissionTo("view_emp_notifications")
        ) {
            return abort(401);
        }
        $users = User::pluck("name", "id");
        return $this->toCreate(compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            !auth()
                ->user()
                ->hasPermissionTo("send_emp_notifications")
        ) {
            return abort(401);
        }
        $messages = [
            "title.required" => "العنوان مطلوب",
            "title.string" => "العنوان يجب ان يكون نص",
            "title.min" => "اقل عدد من الحروف للعنوان هو 3 حروف",
            "title.max" => "اقل عدد من الحروف للعنوان هو 255 حروف",
            "body.required" => "سم الموضوع مطلوب",
            "body.string" => "إسم الموضوع يجب ان يكون نصاً",
        ];
        $this->validate(
            $request,
            [
                "title" => "required|string|min:3|max:255",
                "body" => "required|string",
            ],
            $messages
        );
        $requests = $request->all();
        $requests["creator_id"] = auth()->id();
        $adminNotification = AdminNotification::create($requests);

        $notification_data = [
            "item_id" => $adminNotification->id,
            "message" => $adminNotification->body,
            "type" => "admin_notification",
        ];
        $users = $request->users;
        if ($request->users == [null]) {
            $users = User::pluck("id")->toArray();
        }
        foreach ($users as $user) {
            $arr = [
                "user_id" => $user,
                "data" => $notification_data,
                "type" => "admin_notification",
                "admin_notification_id" => $adminNotification->id,
            ];

            $this->fire(
                $request->title,
                $request->body,
                $notification_data,
                User::where("id", $user)->get()
            );
            Notification::create($arr);
        }

        toast("تم الارسال بنجاح", "success", "top-right");
        return redirect()->route("admin.admin-notifications.index");
    }

    public function myNotifications()
    {
        return view("admin.notifications.index");
    }
}
