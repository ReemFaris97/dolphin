<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsCategoriesResource;
use App\Http\Resources\NotificationsResource;
use App\Http\Resources\UserResource;
use App\Models\Notification;
use App\Models\NotificationCategory;
use App\Traits\ApiResponses;
use App\Traits\UserOperation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use JWTFactory;
use JWTAuth;
use Validator;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    use ApiResponses;

    public function getNotificationsCategories()
    {
        $notifications = NotificationCategory::paginate($this->paginateNumber);
        return $this->apiResponse(
            new NotificationsCategoriesResource($notifications)
        );
    }

    /**
     * Return List of Notifications Categories
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllNotificationsByCategory()
    {
        $notifications = Notification::whereUserId(auth()->user()->id)
            ->orderby("id", "desc")
            ->paginate($this->paginateNumber);
        return $this->apiResponse(new NotificationsResource($notifications));
    }

    public function DeleteAllNotifications()
    {
        auth()
            ->user()
            ->notifications()
            ->delete();
        return $this->apiResponse("تم الحذف بنجاح");
    }

    public function destroy($id)
    {
        $notification = DatabaseNotification::find($id);
        if (!$notification) {
            return $this->notFoundResponse();
        }
        $notification->delete();
        return $this->apiResponse("تم الحذف بنجاح");
    }
}
