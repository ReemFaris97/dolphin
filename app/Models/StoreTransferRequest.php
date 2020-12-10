<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreTransferRequest extends Model
{
    use SoftDeletes;

    protected $fillable = ['sender_id',
    'distributor_id', 'is_confirmed', 'sender_store_id',
        'distributor_store_id'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->withDefault(new User);
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id')->withDefault(new User);
    }

    public function productQuantities()
    {
        return $this->hasMany(ProductQuantity::class, 'store_transfer_request_id');
    }

    public function products()
    {
        return $this->morphMany(AttachedProducts::class, 'model');
    }

    public function distributor_store()
    {
        return $this->belongsTo(Store::class, 'distributor_store_id')->withDefault(new Store);
    }

    public function receiver_store()
    {
        return $this->belongsTo(Store::class, 'receiver_store_id')->withDefault(new Store);
    }

    public function sender_store()
    {
        return $this->belongsTo(Store::class, 'sender_store_id')->withDefault(new Store);
    }

    public function confirmRequest()
    {

        if ($this->sender_store_id != null) {
            $products = $this->products;
            $this->productQuantities()->update(['is_confirmed'=> 1]);
            foreach ($products as $product) {
                ProductQuantity::create([
                    'product_id' => $product->product_id,
                    'user_id' => $this->distributor_id,
                    'quantity' => $product->quantity,
                    'type' => 'in',
                    'is_confirmed' => 1,
                    'store_id' => $this->distributor_store_id,
                    'store_transfer_request_id' => $this->id
                ]);
            }

        }
        $this->update(['is_confirmed' => 1]);
    }
}
