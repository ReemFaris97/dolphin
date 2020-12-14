<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\Store;
use App\Models\StoreTransferRequest;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreTransferController extends Controller
{
    use Viewable;
    private $viewable = 'distributor.storeTransferRequest.';

    public function index(){
        $storeTransfers = StoreTransferRequest::withCount('products')->get()->reverse();
        return $this->toIndex(compact('storeTransfers'));
    }

    public function create(){
        $users = User::where('is_distributor',1)->get();
        $stores = Store::all();
        return $this->toCreate(compact('users','stores'));
    }

    public function store(Request $request){
        $rules = [
            'sender_id'=>"required|numeric|different:distributor_id|exists:users,id",
            'distributor_id'=>"required|numeric|exists:users,id",
            'quantity'=>"required|array|min:1",
            'product_id'=>"required|array|min:1",
        ];
        $messages  = [
            'sender_id.different'=>"يجب اختيار مندوبين مختلفين"
        ];
        $this->validate($request,$rules,$messages);
        $storeTransfer=  StoreTransferRequest::create($request->all());
        $productIds = $request->product_id;
        $quantities = $request->quantity;

        for($i = 0 ; $i <count($productIds); $i++)
        {
            $product = Product::find($productIds[$i]);
            $storeTransfer->products()->create(['quantity'=> $quantities[$i],'price'=>$product->price]);
        }
        toast('تم إضافة العملية بنجاح', 'success','top-right');
        return redirect()->route('distributor.storeTransfer.index');

    }

    public function show($id)
    {

        return $this->toShow(['store' => StoreTransferRequest::findOrFail($id)]);
    }
    public function delete($id){
        StoreTransferRequest::find($id)->delete();
        toast('تم الحذف بنجاح', 'success','top-right');
        return redirect()->route('distributor.storeTransfer.index');
    }
}
