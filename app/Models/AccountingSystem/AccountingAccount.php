<?php

namespace App\Models\AccountingSystem;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingSystem\AccountingAccount
 *
 * @property int $id
 * @property string|null $ar_name
 * @property string|null $en_name
 * @property string|null $kind
 * @property string|null $status
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $account_id
 * @property int|null $active
 * @property int|null $supplier_id
 * @property int|null $store_id
 * @property string|null $amount
 * @property string|null $closing_account
 * @property int|null $safe_id
 * @property int|null $bank_id
 * @property int|null $cost_center
 * @property string|null $openning_balance
 * @property int|null $asset_id
 * @property string|null $level
 * @property string|null $type
 * @property int|null $client_id
 * @property-read AccountingAccount|null $account
 * @property-read \App\Models\AccountingSystem\AccountingAsset|null $asset
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|AccountingAccount[] $children
 * @property-read int|null $children_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|AccountingAccount[] $childrenCostCenter
 * @property-read int|null $children_cost_center_count
 * @property-read AccountingAccount|null $parent
 * @property-read AccountingAccount|null $parents
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|static[] all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|static[] get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount treeOf(callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAccountId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereActive($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAmount($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereArName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereAssetId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereBankId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereClientId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereClosingAccount($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCode($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCostCenter($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereCreatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereEnName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereKind($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereLevel($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereOpenningBalance($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereSafeId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereStatus($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereStoreId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereSupplierId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereType($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount whereUpdatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|AccountingAccount withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @mixin \Eloquent
 */
class AccountingAccount extends Model
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    //   use \Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;
    public function getParentKeyName()
    {
        return 'account_id';
    }
    protected $fillable = ['ar_name','en_name','kind','status','code','account_id','active','amount','supplier_id','store_id','bank_id','cost_center','closing_account',
    'openning_balance','asset_id','level','type','client_id'];
    protected $table='accounting_accounts';
    protected $observables = [
        'posted',
    ];
    public function posted()
    {
        // fire custom event on the model
        $this->fireModelEvent('posted', true);
    }
    public function account()
    {
        return $this->belongsTo(AccountingAccount::class, 'account_id');
    }

    public function asset()
    {
        return $this->belongsTo(AccountingAsset::class, 'asset_id');
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
        return $this->belongsTo(AccountingAccount::class, 'account_id');
    }

    public function children()
    {
        return $this->hasMany(AccountingAccount::class, 'account_id');
    }


    public function childrenCostCenter()
    {
        return $this->hasMany(AccountingAccount::class, 'account_id')->where('cost_center', 1)->where('kind', 'sub');
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

    public function logs_debtor($request=null)
    {
        $transaction=AccountingAccountLog::where('account_id', $this->id)->where('affect', 'creditor');
        if ($request->has('from') && $request->has('to')) {
            $transaction = $transaction->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        } else {
            $transaction = $transaction->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()]);
        }
        return $transaction->sum('amount');
    }

    public function logs_creditor($request=null)
    {
        $transaction=AccountingAccountLog::where('account_id', $this->id)->where('affect', 'creditor');
        if ($request->has('from') && $request->has('to')) {
            $transaction = $transaction->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        } else {
            $transaction = $transaction->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()]);
        }
        return $transaction->sum('amount');
    }
}
