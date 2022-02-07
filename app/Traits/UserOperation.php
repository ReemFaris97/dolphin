<?php

namespace App\Traits;

use App\Address;
use App\Models\User;
use Illuminate\Support\Arr;

trait UserOperation
{
    public function RegisterUser($request)
    {
        $inputs = $request->all();
        if ($request->image != null) {
            if ($request->hasFile("image")) {
                $inputs["image"] = saveImage($request->image, "users");
            }
        }

        $inputs["is_supplier"] = 1;
        $inputs["verification_code"] = 1234;
        return User::create($inputs);
    }

    public function UpdateUserProfile($user, $request)
    {
        $inputs = $request->all();
        if ($request->image != null) {
            if ($request->hasFile("image")) {
                $user->update(["image" => saveImage($request->image, "image")]);
            }
        }
        if ($request->password != null) {
            return $user->update(Arr::except($inputs, ["image"]));
        }
        return $user->update(Arr::except($inputs, ["image", "password"]));
    }

    public function RegisterSupplierEmployee($request)
    {
        $inputs = $request->all();
        $inputs["parent_user_id"] = auth()->id();
        $inputs["is_supplier"] = 1;
        $inputs["supplier_type"] = "dolphin";
        $user = User::create($inputs);
        $user->syncPermissions($request->permissions);
        return $user;
    }

    public function UpdateSupplierEmployee($request, $user)
    {
        $user->update($request->all());
        $user->syncPermissions($request->permissions);
        return $user;
    }
}
