<?php
namespace  App\Traits;

use Illuminate\Support\Facades\Hash;

trait HashPassword
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function bootHashPassword()
    {
        static::creating(function ($user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });


        static::updating(function ($user) {
            if ($user->password != null && Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }
}
