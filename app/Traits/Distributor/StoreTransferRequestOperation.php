<?php


namespace App\Traits\Distributor;


use App\Models\Charge;
use App\Models\Clause;
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\StoreTransferRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use App\Models\User;

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

            foreach ($request->products??[] as $item) {
                $product = Product::find($item['product_id']);
                $request_transfer->products()->create(
                    [
                        'product_id'=>$product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price
                    ]);

                // if (isset($request->sender_store_id)) {
                    ProductQuantity::create([
                        'product_id' => $product->id,
                        'user_id' => $request->sender_id,
                        'quantity' => $item['quantity'],
                        'type' => 'out',
                        'is_confirmed' => 0,
                        'store_id' => $request->sender_store_id,
                        'store_transfer_request_id' => $request_transfer->id
                    ]);

                // }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }





//         DB::beginTransaction();
//         try {
//             $inputs = $request->all();

//             // $request_transfer = StoreTransferRequest::create($inputs);
//             foreach ($request->products ?? [] as $item) {
//                 $product = Product::find($item['product_id']);
//                 // $request_transfer->products()->create(
//                 //     [
//                 //         'product_id'=>$product->id,
//                 //         'quantity' => $item['quantity'],
//                 //         'price' => $product->price
//                 //     ]);

//              //   if (isset($request->sender_store_id)) {
//                     ProductQuantity::create([
//                         'product_id' => $product->id,
//  //                       'user_id' => $request->sender_id,
//                         'quantity' => $item['quantity'],
//                     'type' => 'in',
//                         'is_confirmed' => 0,
//                         'store_id' => $request->sender_store_id,
//                       //  'store_transfer_request_id' => $request_transfer->id
//                     ]);

//               //  }
//             }
//             DB::commit();
//             return true;
//         } catch (\Exception $e) {
//             DB::rollback();
//             dd($e);
//             return false;
//         }
    }


}
