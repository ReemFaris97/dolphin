<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorCar;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;

class DistributorsController extends Controller
{
    use Viewable;

    private $viewable = 'distributor.distributors.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $distributors = User::where('is_distributor', 1)->get()->reverse();
        return $this->toIndex(compact('distributors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = DistributorCar::Available()->get();
        return $this->toCreate(compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   dd($request->all());
        $rules = [
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|max:191',
            'image' => 'nullable|mimes:jpg,jpeg,gif,png',
            'target' => 'nullable|integer',
            'affiliate' => 'nullable|numeric',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'car_id' => 'required|numeric|exists:distributor_cars,id|unique:users,car_id,',


        ];

        $this->validate($request, $rules);

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $requests['is_distributor'] = 1;
        $car = DistributorCar::find($request->car_id);
        \DB::beginTransaction();
        $user = User::query()->create($requests);
        if ($car) {
            $user->createCarStore($car->id);

        }
        $user->createDamageStore();
        DB::commit();
        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.distributors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return $this->toShow([
            'user' => User::with('routes')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $cars = DistributorCar::Available()->get();

        $car = $user->car_store;

        $user->car_id = optional($car)->car_id;
        if ($user->car_id != null) {
            $cars = $cars->push($car->car);
        }
        return $this->toEdit(compact('user', 'user', 'cars'));
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
        /** @var User $user */
        $user = User::query()->findOrFail($id);

        $rules = [
            'name' => 'required|string|max:191',
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'email' => 'required|string|unique:users,email,' . $user->id,
            'image' => 'nullable|sometimes|image',
            'car_id' => 'required|numeric|exists:distributor_cars,id|unique:users,car_id,' . $id,
            'target' => 'nullable|integer',
            'affiliate' => 'nullable|numeric',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
        $this->validate($request, $rules);
        $requests = $request->except('image', 'password');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        if ($request->password != null && !\Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->withErrors(['old_password' => 'كلمه المرور القديمه غير صحيحه']);
        }
//dd($requests);
        $user->fill($requests);
//        $user->syncPermissions($request->permissions);
        $user->save();
        $user->updateCarStore($request->car_id);

        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.distributors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {
//        if (!auth()->user()->hasPermissionTo('delete_workers')) {
//            return abort(401);
//        }

        User::find($id)->forceDelete();
        toast('تم الحذف', 'success', 'top-right');
        return back();
    }

    public function block($id)
    {
        $user = User::find($id);

        $blocked_at = $user->blocked_at;
        if ($blocked_at == null) {
            $user->fill(['blocked_at' => Carbon::now()]);
        } else {
            $user->fill(['blocked_at' => null]);
        }
        $user->save();
        toast('تم التعديل', 'success', 'top-right');
        return back();
    }
}
