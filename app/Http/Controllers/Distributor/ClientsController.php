<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

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
        return $this->toCreate();
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
                    'email'=>'required|string|unique:clients,email',
                    'store_name'=>'required|string|max:191',
                    'address'=>'required|string|max:191',
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
        return $this->toShow(compact('clients'));

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
        return $this->toEdit(compact('user'));
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
            'phone'=>'required|numeric|unique:clients,phone',
            'email'=>'required|string|unique:clients,email',
            'store_name'=>'required|string|max:191',
            'address'=>'required|string|max:191',
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


    public function confirm($id)
    {
        $client =Client::find($id);
        $client->update([
            'is_active' => '1'
        ]);
        toast('تم الغاء تفعيل العميل', 'success', 'top-right');

        return back();
    }
}
