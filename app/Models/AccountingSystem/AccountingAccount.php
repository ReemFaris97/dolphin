<?php

namespace App\Models\AccountingSystem;

use Illuminate\Database\Eloquent\Model;

class AccountingAccount extends Model

{
//  use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

  use \Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;

    protected $fillable = ['ar_name','en_name','kind','status','code','account_id','active','amount','supplier_id','store_id','bank_id','cost_center'];
    protected $table='accounting_accounts';




    protected $observables = [
        'posted',

    ];

    public function posted()
    {
      // fire custom event on the model
      $this->fireModelEvent('posted',true);

    }
    public function account()
    {
     return $this->belongsTo(AccountingAccount::class,'account_id');
    }



//    public function getParentKeyName()
//    {
//        return 'account_id';
//    }
//    public function getLocalKeyName()
//    {
//        return 'id';
//    }
//    public function balance()
//    {
//         dd($this->descendants()->get());
//    }
//    public function children()
//    {
//        return $this->hasMany(AccountingAccount::class,'account_id');
//    }
//
//    public  function ancestors()
//    {
////        $all=[];
////        foreach ($this->children as $child) {
////         array_push(  $all,$child->where('account_id',$child->id));
////        }
////        dd($all);
//        return $this->where('account_id',$this->id)->with('children')->get();
//    }
//
    public function parents()
    {
        return $this->belongsTo(AccountingAccount::class,'account_id');
    }

    public function children()
    {
        return $this->hasMany(AccountingAccount::class,'account_id');
    }


    public function allChildrenAccounts()
    {
        return $this->children()->with('allChildrenAccounts');
    }



//    public function balance()
//    {
//        if ($this->kind=='sub')
//            return $this->amount;
//        else{
//            $balance=AccountingAccount::where('account_id',$this->id)->sum('amount');
//            return  $balance;
//        }
//
//    }


////    public  function  all_blances(){
////
////            $balance=$this->allChildrenAccounts->count();
////
////                foreach ($this->allChildrenAccounts as $child) {
////
////    //               $balance += $child->allChildrenAccounts->sum('amount');
////                           $balance+= $child->Children->count();
////
////                }
////                            dd($balance);
////                return $balance;
////
////
////    }
}
