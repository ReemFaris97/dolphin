<?php


namespace App\Traits;


use App\Address;
use App\User;
use Illuminate\Support\Arr;

trait UserOperation
{
    public function RegisterUser($request)
  {
      $inputs = $request->all();
      if ($request->image != null)
      {
          if ($request->hasFile('image')) {
              $inputs['image'] = saveImage($request->image,'users');
          }
      }

      $inputs['is_supplier'] = 1;
       return User::create($inputs);
  }

    public function UpdateUserProfile($user,$request)
    {
        $inputs = $request->all();
        if ($request->image != null)
        {
            if ($request->hasFile('image'))
                $user->update(['image' => saveImage($request->image, 'image')]);
        }
        if($request->password != null) {return $user->update( Arr::except($inputs,['image']));}
        return $user->update(Arr::except($inputs,['image','password']));
    }

}
