<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Suppliers\UserResource;
use App\Models\Supplier\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = auth()->user()->parent ?? auth()->user();
        return \responder::success(UserResource::collection($parent->children));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            "name" => "required|string",
            "phone" => "required|unique:suppliers_users,phone|phone:sa,eg",
            "email" => "required|email|unique:suppliers_users,email",
            "password" => "required|min:6",
            "permissions" => "required|array",
        ]);
        $parent = auth()->user()->parent ?? auth()->user();
        $inputs["supplier_id"] = $parent->supplier_id;
        $user = $parent->children()->create($inputs);
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    "إضافة موظف {$user->name}"
                )
            );

        return \responder::success(new UserResource($user));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $inputs = $request->validate([
            "name" => "sometimes|string",
            "phone" =>
                "sometimes|phone:sa,eg|unique:suppliers_users,phone," .
                $user->id,
            "email" =>
                "sometimes|email|unique:suppliers_users,email," . $user->id,
            "password" => "sometimes|min:6",
            "permissions" => "sometimes|array",
        ]);
        $user->update($inputs);
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    "تعديل موظف {$user->name}"
                )
            );
        return \responder::success(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $auth = auth()->user();
        if ($auth->id() == $user->id or $user->id == $user->parent_id) {
            return \responder::error("عفوا لايمكن المسح يرجي مراجعة المسؤل");
        }
        activity()
            ->causedBy(auth()->user())
            ->log(
                sprintf(
                    "قام %s ب %s",
                    auth()->user()->name,
                    "حذف موظف {$user->name}"
                )
            );
        $user->delete();
        return \responder::success("تم الحذف بنجاح !");
    }
}
