<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientClass;
use App\Models\DistributorRoute;
use App\Traits\Viewable;
use App\Models\User;
use App\Models\User as AppUser;
use Illuminate\Foundation\Auth\User as AuthUser;

class ClientsController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.clients.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all()->reverse();

        return $this->toIndex(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distributors=AppUser::whereIsDistributor(1)->pluck('name','id')->toArray();
        $routes=DistributorRoute::pluck('name','id')->toArray();
        $client_classes = ClientClass::active()->pluck('name', 'id');

        return $this->toCreate(compact('distributors', 'routes', 'client_classes'));
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
                    'name'=>'required|string|max:191',
                    'phone'=>'required|numeric|unique:clients,phone',
            // 'email'=>'required|string|unique:clients,email',
            'tax_number' => 'required|string|unique:clients,tax_number',

                    'store_name'=>'required|string|max:191',
                    'address'=>'required|string|max:191',
            'client_class_id' => 'required|integer|exists:client_classes,id',
                    'lat'=>'required',
                    'lng'=>'required'
                ];
         $messages =[
             'lat.required'=>"الموقع على الخريطة مطلوب",
             'lng.required'=>"الموقع على الخريطة مطلوب",
         ];
                $this->validate($request,$rules,$messages);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        Client::create($requests);
                toast('تم الاضافه بنجاح', 'success', 'top-right');
                return redirect()->route('distributor.clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activation()
    {
        $clients = Client::where('is_active',0)->get()->reverse();
        return view('distributor.clients.activations',compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Client::findOrFail($id);
        $distributors=AppUser::whereIsDistributor(1)->pluck('name','id')->toArray();
        $routes=DistributorRoute::pluck('name','id')->toArray();
        $client_classes = ClientClass::active()->pluck('name', 'id');

        return $this->toEdit(compact('user', 'distributors', 'routes', 'client_classes'));
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
        $user = Client::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',
            'phone' => 'required|numeric|unique:clients,phone,' . $id,
            // 'email'=>'required|string|unique:clients,email',
            'tax_number' => 'required|string|unique:clients,tax_number,' . $id,
            'store_name'=>'required|string|max:191',
            'address'=>'required|string|max:191',
            'client_class_id' => 'required|integer|exists:client_classes,id',
            'lat'=>'required',
            'lng'=>'required'
        ];
        $messages =[
            'lat.required'=>"الموقع على الخريطة مطلوب",
            'lng.required'=>"الموقع على الخريطة مطلوب",
        ];
        $this->validate($request,$rules,$messages);
        $user->update($request->all());
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.clients.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Client::find($id)->forceDelete();
        toast('تم الحذف', 'success', 'top-right');
        return back();
    }

    public function active($id)
    {
        $client =Client::find($id);
        $client->update([
            'is_active' => '1'
        ]);
        toast('تم تفعيل العميل', 'success', 'top-right');

        return back();
    }


    public function disactive($id)
    {
        $client =Client::find($id);
        $client->update(['is_active' => '0'
        ]);
        toast('تم الغاء تفعيل العميل', 'success', 'top-right');

        return back();
    }

    public function show($id)
    {
        return $this->toShow([
            'client' =>Client::findOrFail($id)
        ]);
    }
}
