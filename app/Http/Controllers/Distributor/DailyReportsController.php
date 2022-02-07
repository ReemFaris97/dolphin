<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DailyReport;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
class DailyReportsController extends Controller
{
    use Viewable;
    private $viewable = "distributor.dailyReports.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dailyReports = DailyReport::FilterWithDates(
            $request->from,
            $request->to
        )
            ->get()
            ->reverse();
        return $this->toIndex(compact("dailyReports"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where("is_distributor", 1)->get();
        $stores = Store::all();
        return $this->toCreate(compact("users", "stores"));
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
            "user_id" => "required|numeric|exists:users,id",
            //            'cash'=>"nullable|numeric",
            //            'expenses'=>"nullable|numeric",
            "image" => "required|image",
            //            'quantity'=>"required|array|min:1",
            //            'product_id'=>"required|array|min:1",
        ];
        $this->validate($request, $rules);
        $inputs = $request->all();
        //      dd($inputs);
        if ($request->image != null) {
            if ($request->hasFile("image")) {
                $inputs["image"] = saveImage($request->image, "users");
            }
        }

        $report = DailyReport::create($inputs);

        $productIds = $request->products;
        //        $quantities = $request->package;

        foreach ($productIds as $key => $product_) {
            $product = Product::find($product_["product_id"]);
            $report->products()->create([
                "quantity" => $product_["quantity"],
                "price" => $product->price,
            ]);
        }

        toast("تم إضافة العملية بنجاح", "success", "top-right");
        return redirect()->route("distributor.dailyReports.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->toShow([
            "report" => DailyReport::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DailyReport::find($id)->delete();
        toast("تم مسح العملية بنجاح", "success", "top-right");
        return redirect()->route("distributor.dailyReports.index");
    }
}
