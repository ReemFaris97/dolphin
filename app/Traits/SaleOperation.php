<?php
namespace  App\Traits;

use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingSaleItem;
use App\Models\AccountingSystem\AccountingStore;

trait SaleOperation
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function createItem($request,$sale)
    {

        $requests = $request->all();
        $products=$requests['product_id'];
        $quantities=$requests['quantity'];
        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);
        $unit_id = collect($requests['unit_id']);
        $merges = $products->zip($qtys,$unit_id);

        foreach ($merges as $merge)
        {
            $product=AccountingProduct::find($merge['0']);
            if($merge['2']!='main-'.$product->id){
                $unit=AccountingProductSubUnit::where('product_id',$merge['0'])->where('id',$merge['2'])->first();
                if($unit){
                    $unit->update([
                        'quantity'=>$unit->quantity - $merge['1'],
                    ]);

                }
            }
                $item= AccountingSaleItem::create([
                    'product_id'=>$merge['0'],
                    'quantity'=> $merge['1'],
                    'price'=>$product->selling_price,
                    'sale_id'=>$sale->id
                ]);
                ///if-main-unit

                if($merge['2']!='main-'.$product->id){

                    $unit=AccountingProductSubUnit::where('product_id',$merge['0'])->where('id',$merge['2'])->first();
                    if($unit){
                        $unit->update([
                            'quantity'=>$unit->quantity - $merge['1'],
                        ]);

                    }
                    $productstore=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->where('product_id',$merge['0'])->where('unit_id',$merge['2'])->first();
                   if ($productstore) {
                       if ($productstore->quantity >= 0) {
                           $productstore->update([
                               'quantity' => $productstore->quantity - $merge['1'],
                           ]);
                       }
                   }
                }else{
                    $productstore=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->where('product_id',$merge['0'])->where('unit_id',Null)->first();
                    if ($productstore) {
                        if($productstore->quantity >= 0) {
                            if ($productstore) {
                                $productstore->update([
                                    'quantity' => $productstore->quantity - $merge['1'],
                                ]);
                            }
                        }
                    }

                    $product=AccountingProduct::findOrFail($merge['0']);
                    if ($product) {
                        if($product->quantity >= 0) {
                            if ($product) {
                                $product->update([
                                    'quantity' => $product->quantity - $merge['1'],
                                ]);
                            }
                        }
                    }
                }

    }



    }
    public static function editItem($request,$sale)
    {


        $requests = $request->all();


        $products = collect($requests['product_id_old']);
        $qtys = collect($requests['quantity_old']);
        $unit_id = collect($requests['unit_id_old']);
        $prices = collect($requests['prices_old']);
        $merges = $products->zip($qtys,$unit_id,$prices);
         foreach($merges as $merge){
            $product=AccountingProduct::find($merge['0']);

            $item_old=AccountingSaleItem::where('sale_id',$sale->id)->where('product_id',$merge[0])->first();
      if($item_old){
            $item_old->update([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>$merge['3'],
                'unit_id'=>null,
                'unit_type'=>'main',
                'sale_id'=>$sale->id
            ]);
         }
        }
    }

}
