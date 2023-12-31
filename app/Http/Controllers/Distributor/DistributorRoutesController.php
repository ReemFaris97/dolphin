<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class DistributorRoutesController extends Controller
{
    use Viewable;
    private $viewable= 'distributor.routes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes= DistributorRoute::all()->reverse();
        return $this->toIndex(compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::where('is_distributor','1')->pluck('name','id');
        return $this->toCreate(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id'=>'required|exists:users,id',
            'name'=>'required|string',
            'is_active'=>'required|numeric',

        ];

        $this->validate($request,$rules);
        DistributorRoute::create($request->all());
        toast('تم المسار بنجاح','success','top-right');
        return redirect()->route('distributor.routes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = DistributorRoute::findOrFail($id);
        $users = User::whereIsDistributor(1)->pluck('name','id');
        return $this->toEdit(compact('route','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $route = DistributorRoute::find($id);
        $rules = [
            'user_id'=>'required|exists:users,id',
            'name'=>'required|string',
            'is_active'=>'required|numeric',

        ];

        $this->validate($request,$rules);
        $route->update($request->all());
        toast('تم تعديل المسار بنجاح','success','top-right');
        return redirect()->route('distributor.routes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = DistributorRoute::find($id);
        $route->delete();
        toast('تم حذف التحويل بنجاح','success','top-right');
        return redirect()->route('distributor.routes.index');
    }
}
