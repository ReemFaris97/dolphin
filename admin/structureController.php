<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Banner;
use App\City;
use App\Group;
use App\News;
use App\Structure;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Activity;
class structureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.structures.index')->with('structures',Structure::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.structures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[

            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
            'ar_desc'=>'required|string|',
            'en_desc'=>'required|string|',



        ]);

        $image = uploader($request, 'image');


        $inputs = $request->all();
        $inputs['image'] = $image;



       Structure::create($inputs);

        alert()->success('تم اضافة الهيكل التنظيمى بنجاح  !')->autoclose(5000);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $structure=Structure::find($id);

        return view('admin.structures.edit',compact('structure'));
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
        $structure=Structure::find($id);
        //

        $this->validate($request, [

            'ar_name'=>'required|string|',
            'en_name'=>'required|string|',
            'ar_desc'=>'required|string|',
            'en_desc'=>'required|string|',



        ]);

        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $image = uploader($request, 'image');
            $inputs['image'] = $image;


        }
        $structure->update($inputs);

        alert()->success('تم تعديل  الهيكل التنظيمى بنجاح !')->autoclose(5000);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $structure=Structure::find($id);


        $structure->delete();

        alert()->success('تم حذف الهيكل التنظيمى بنجاح !')->autoclose(5000);

        return back();
    }

}
