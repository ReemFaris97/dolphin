<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorCar;
use App\Models\Reader;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ReaderController extends Controller
{

    use Viewable;
    private  $viewable = 'distributor.readers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = Reader::all()->reverse();
       // dd($readers);
        return $this->toIndex(compact('readers'));
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

        ];
        $this->validate($request,$rules);

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        Reader::create($requests);
        toast('تم إضافة العداد بنجاح','success','top-right');
        return redirect()->route('distributor.readers.index');
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
        $reader = Reader::findOrFail($id);

        return $this->toEdit(compact('reader'));
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
        $reader= Reader::find($id);

        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $reader->update($requests);
        toast('تم تعديل  العداد بنجاح','success','top-right');
        return redirect()->route('distributor.readers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reader::find($id)->delete();
        toast('تم حذف العداد بنجاح','success','top-right');
        return redirect()->route('distributor.readers.index');
    }

    public function changeStatus($id)
    {
        $item=Reader::find($id);
        if ($item->is_active == 1) {
            $item->update(['is_active'=>0]);
            toast('تم إلغاء التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.readers.index');
        } else {
            $item->update(['is_active'=>1]);
            toast('تم  التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.readers.index');
        }
    }
}
