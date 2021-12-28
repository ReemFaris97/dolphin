<?php

namespace App\Models\Supplier;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'suppliers_products';
    use HasFactory, HasImages;

    protected $images = ['image'];
    protected $fillable = ['name', 'barcode', 'unit', 'notes', 'price', 'expire_at', 'image', 'is_active'];


}
