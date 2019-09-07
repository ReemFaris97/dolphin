<?php


namespace App\Traits\Distributor;



use App\Models\Charge;
use App\Models\Clause;
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\StoreTransferRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait StoreTransferRequestOperation
{
    /**
     * Register New Store Request
     *
     * @param $request
     * @return mixed
     */
    public function AddStoreTransferRequest($request)
  {
      DB::beginTransaction();
      try {
          $inputs = $request->all();
          $request_transfer = StoreTransferRequest::create($inputs);
          foreach ($request->products as $item)
          {
              $product = Product::find($item['product_id']);
              $request_transfer->products()->create(['quantity'=> $item['quantity'],'price'=>$product->price]);
          }
          DB::commit();

          return true;
      } catch (\Exception $e) {
          DB::rollback();
          dd($e);
          return false;
      }
  }


}
