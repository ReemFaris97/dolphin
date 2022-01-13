<?php

namespace App\Models\Chat;

use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingSupplierCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable=['accounting_company_id','accounting_supplier_id'];
    protected $touches = ['messages'];

    public function chatUsers()
    {
        return $this->hasMany(ChatUser::class);
    }

    public function getNameAttribute()
    {
        $names = [];
        foreach ($this->chatUsers as $chatUser) {
            $names[] = $chatUser->user->name;
        }

        return implode('|', $names);
    }

    public function supplier()
    {
        return $this->belongsTo(AccountingSupplier::class,'accounting_supplier_id');
}
    public function company()
    {
        return $this->belongsTo(AccountingCompany::class,'accounting_company_id');
}
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
