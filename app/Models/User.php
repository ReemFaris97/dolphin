<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Models\Bank;
use App\Models\Charge;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\FcmToken;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Product;
use App\Models\RouteTrips;
use App\Models\SupplierBill;
use App\Models\SupplierLog;
use App\Models\SupplierPrice;
use App\Models\SupplierTransaction;
use App\Models\TaskUser;
use App\Traits\ApiResponses;
use App\Traits\FirebasOperation;
use App\Traits\HashPassword;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, softDeletes, HasRoles, HashPassword, ApiResponses, FirebasOperation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin', 'remember_token'
        , 'is_distributor', 'is_supplier', 'supplier_type', 'tex_number', 'lat', 'lng', 'bank_id', 'verification_code', 'parent_user_id', 'bank_account_number',
        'distributor_status', 'settle_commission', 'sell_commission', 'reword_value', 'store_id', 'route_id', 'is_storekeeper', 'enable'
        , 'accounting_store_id', 'is_saler', 'is_accountant', 'delete_product', 'role_id', 'hiring_date', 'salary', 'title_id', 'is_active' ,'target', 'affiliate', 'address', 'notes','ordering_coin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'fcm_token_android', 'fcm_token_ios'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function title()
    {
        return $this->belongsTo(AccountingJobTitle::class, 'title_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user_charge()
    {
        return $this->hasMany('App\Models\Charge', 'worker_id');
    }

    public function supervisor_charge()
    {
        return $this->hasMany('App\Models\Charge', 'supervisor_id');
    }


    public function IsDistributor(): bool
    {

        return $this->is_distributor ? 1 : 0;
    }


    public function IsSupplier(): bool
    {
        return $this->is_supplier ? 1 : 0;
    }

    public function getTypeAttribute()
    {
        if ($this->is_admin == 0) {

            return 'عضو';
        }
        return 'مدير';

    }

    public function tokens()
    {
        return $this->hasMany(FcmToken::class, 'user_id');
    }



    /**
     * Block The User.
     *
     * @return void
     */
    public function block()
    {
        if (is_null($this->blocked_at)) {
            $this->forceFill(['blocked_at' => $this->freshTimestamp()])->save();
        }
    }

    public function rate()
    {
        $finished_tasks_rate = $this->tasks()->whereMonth('finished_at', date('m'))->whereNotNull('rate')->avg('rate');
        return floatval($finished_tasks_rate);
    }


    /**
     * Determine if a The user has been blocked.
     *
     * @return bool
     */
    public function isBlocked()
    {
        return $this->blocked_at !== null;
    }

    public function ScopeAvailable(Builder $builder): void
    {
        $builder->whereNull('blocked_at');
    }

    public function ScopeDistributor(Builder $builder): void
    {
        $builder->where('is_distributor', 1);
    }


    public function store()
    {
        return $this->belongsTo(AccountingStore::class, 'accounting_store_id');
    }
    public function stores()
    {
        return $this->hasMany(Store::class, 'distributor_id');
    }


    public function updateFcmToken($token, $device)
    {
        FcmToken::updateOrCreate([
            'device' => $device,
            'user_id' => $this->id,
        ],
            [
                'token' => $token,
                'device' => $device,
                'user_id' => $this->id,
            ]);
    }

    public function tasks()
    {
        return $this->hasMany(TaskUser::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->orderBy('created_at', 'desc');
    }


    public function scopeOfClient(Builder $builder, $client_id)
    {

        $this->whereHas('trips', function ($trip) use ($client_id) {
            $trip->where('client_id', $client_id);
        });
    }


    public function scopeSearchByName(Builder $builder): void
    {
        $builder->where(
            function ($q) {
                $q->where('name', 'Like', '%' . \request('name'));
                $q->orWhere('name', 'Like', '%' . \request('name') . '%');
                $q->orWhere('name', 'Like', \request('name'));
            }
        );
    }
    /**
     * Send the given notification.
     *
     * @param mixed $instance
     * @return void
     */
    public function sendNotification($data, $type)
    {
        $a =        $this->notifications()->create([
            'data' => $data,
            'type' => $type
        ]);
    }


    public function total_message_pages($user_id)
    {

        $messages = Message::with('user')
            ->where(['user_id' => auth()->user()->id, 'receiver_id' => $user_id])
            ->orWhere(function ($query) use ($user_id) {
                $query->where(['user_id' => $user_id, 'receiver_id' => auth()->user()->id]);
            })->count();

        if ($messages == 0) return 0;
        $pagniation = $this->paginateNumber;
        return ceil($messages / $pagniation);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(DistributorRoute::class, 'user_id')->withCount('trips');
    }

    public function trips(): HasManyThrough
    {
        return $this->hasManyThrough(RouteTrips::class, DistributorRoute::class, 'user_id', 'route_id');
    }

    public function accounting_store()
    {
        return $this->belongsTo(AccountingStore::class, 'accounting_store_id');
    }


//    ************************************************
    /*
     *
     * @Supplier Functions ....
     *
     */

    public function supplier_staff()
    {
        return $this->hasMany(User::class, 'parent_user_id');
    }

    public function supplierLog()
    {
        return $this->hasMany(SupplierLog::class, 'user_id');
    }

    public function supplierBills()
    {
        return $this->hasMany(SupplierBill::class, 'supplier_id');
    }


    public function supplierProducts()
    {

        $ids = SupplierPrice::where('user_id', $this->id)->pluck('product_id');
        $products = Product::whereIn('id', $ids)->get();
        return $products;
    }

    public function supplierProductsPaginated()
    {
        $ids = SupplierPrice::where('user_id', $this->id)->pluck('product_id');
        $products = Product::whereIn('id', $ids)->paginate(10);
        return $products;
    }

    public function checkIfProductAddedBefore($productId)
    {
        $check = SupplierPrice::where('product_id', $productId)->where('user_id', $this->id)->first();
        if ($check) return 1;
        else return 0;
    }

    public function supplier_transactions()
    {
        return $this->hasMany(SupplierTransaction::class, 'supplier_id');
    }
    public function distributor_transactions()
    {
        return $this->hasMany(DistributorTransaction::class, 'user_id');
    }
    public function sender_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, 'sender');
    }

    public function supplierTotalBills()
    {
        $amount = $this->supplierBills()->sum('vat');
        $amount += $this->supplierBills()->sum('amount_paid');
        $amount += $this->supplierBills()->sum('amount_rest');
        return $amount;
    }

    public function totalPaidMoneyInBill(): float
    {
        return $amount = $this->supplierBills()->sum('amount_paid');

    }

    public function supplierPaidMoneyInTransactions(): float
    {
        return $this->supplier_transactions()->sum('amount');
    }

    public function supplierTotalPaidMoney(): float
    {
        return $this->totalPaidMoneyInBill() + $this->supplierPaidMoneyInTransactions();
    }

    public function totalRestMoneyInBill()
    {
        return $this->supplierBills()->sum('amount_rest');
    }

    public function TotalOfSupplierReceivables(): float
    {
        $amount_rest = $this->totalRestMoneyInBill();
        $paid = $this->supplierPaidMoneyInTransactions() + $this->totalPaidMoneyInBill();
        return $amount_rest - $paid;
    }

    public function getLastLocationAttribute()
    {

        return optional($this
            ->trips()
           // ->where('status', 'accepted')
          //  ->orderBy('arrange', 'asc')
            ->orderBy('updated_at', 'desc')
            ->first());
    }

    //    ******************************************************

    public  function all_transactions()
    {
        return DistributorTransaction::UserTransactions($this->id)->walletOf($this->id)->get();
    }
    public  function distributor_wallet()
    {
        return $this->all_transactions()->sum('balance');
    }


}
