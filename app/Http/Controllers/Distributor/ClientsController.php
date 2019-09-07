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
                Client::create($request->all());
                toast('تم الاضافه بنجاح', 'success', 'top-right');
                return redirect()->route('distributor.clients.index');
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

    public function block($id){

    }
}
