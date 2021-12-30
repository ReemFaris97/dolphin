<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table='suppliers_banks';
    protected $fillable=['name','iban','owner_name','accounting_supplier_id'];


}
