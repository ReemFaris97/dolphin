<?php

namespace App\Http\Controllers\Distributor;

use App\Models\ClientClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ClientClassController extends Controller
{

    use Viewable;
    private  $viewable = 'distributor.client_classes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client_classes = ClientClass::all()->reverse();
        // dd($client_classes);
        return $this->toIndex(compact('client_classes'));
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

            'name' => 'required|string|max:191',

        ];
        $this->validate($request, $rules);

        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        DB::beginTransaction();
        /** @var \App\Models\ClientClass  $client_class*/
        $client_class = ClientClass::query()->create($requests);

        $products = Product::query()->whereDoesntHave('client_classes', function (Builder $builder) use ($client_class) {
            $builder->where('client_class_id', $client_class->id);
        })->get();
        foreach ($products as $product) {
            $client_class->products()->attach($product->id, ['price' => $product->price]);
        }
        DB::commit();

        toast('تم إضافة الشريحة بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.client-classes.index');
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
        $client_class = ClientClass::findOrFail($id);

        return $this->toEdit(compact('client_class'));
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
        $client_class = ClientClass::find($id);

        $rules = [
            'name' => 'required|string|max:191',

        ];
        $this->validate($request, $rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        $client_class->update($requests);
        toast('تم تعديل الشريحة بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.client-classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClientClass::find($id)->delete();
        toast('تم حذف  بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.client-classes.index');
    }

    public function changeStatus($id)
    {
        $item = ClientClass::find($id);
        if ($item->is_active == 1) {
            $item->update(['is_active' => 0]);
            toast('تم إلغاء التفعيل بنجاح', 'success', 'top-right');
            return redirect()->route('distributor.client-classes.index');
        } else {
            $item->update(['is_active' => 1]);
            toast('تم  التفعيل بنجاح', 'success', 'top-right');
            return redirect()->route('distributor.client-classes.index');
        }
    }
}
