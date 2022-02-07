<?php

namespace App\Models;

use App\Models\AccountingSystem\AccountingAllowance;
use App\Models\AccountingSystem\AccountingAttendance;
use App\Models\AccountingSystem\AccountingAttentance;
use App\Models\AccountingSystem\AccountingBonusDiscount;
use App\Models\AccountingSystem\AccountingDebt;
use App\Models\AccountingSystem\AccountingHoliday;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingSalary;
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

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $image
 * @property string|null $job
 * @property string|null $nationality
 * @property string|null $company_name
 * @property string|null $blocked_at
 * @property int $is_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property int $is_distributor
 * @property int $is_supplier
 * @property string $supplier_type
 * @property string|null $tax_number
 * @property string|null $lat
 * @property string|null $lng
 * @property int $is_verified
 * @property int|null $verification_code
 * @property int|null $parent_user_id
 * @property int|null $bank_id
 * @property string|null $bank_account_number
 * @property string|null $distributor_status
 * @property string|null $settle_commission
 * @property string|null $sell_commission
 * @property string|null $reword_value
 * @property int|null $store_id
 * @property int $is_storekeeper
 * @property int|null $accounting_store_id
 * @property int $is_saler
 * @property int|null $is_accountant
 * @property int|null $delete_product
 * @property int|null $role_id
 * @property string|null $hiring_date
 * @property string|null $salary
 * @property int|null $title_id
 * @property int $enable
 * @property int|null $target
 * @property string|null $affiliate
 * @property string|null $address
 * @property string|null $notes
 * @property string|null $ordering_coin
 * @property int $car_id
 * @property string $holiday_balance
 * @property-read AccountingStore|null $accounting_store
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingAllowance[] $allowances
 * @property-read int|null $allowances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingAttendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read Bank|null $bank
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingBonusDiscount[] $bonus_discount
 * @property-read int|null $bonus_discount_count
 * @property-read \App\Models\Store $car_store
 * @property-read \App\Models\Store|null $damaged_store
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingDebt[] $debts
 * @property-read int|null $debts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|DistributorTransaction[] $distributor_transactions
 * @property-read int|null $distributor_transactions_count
 * @property-read mixed $fcm_token_android
 * @property-read mixed $fcm_token_ios
 * @property-read mixed $fcm_token_web
 * @property-read mixed $last_location
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingHoliday[] $holidays
 * @property-read int|null $holidays_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Message[] $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|DistributorRoute[] $routes
 * @property-read int|null $routes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|AccountingSalary[] $salaries
 * @property-read int|null $salaries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|DistributorTransaction[] $sender_transactions
 * @property-read int|null $sender_transactions_count
 * @property-read AccountingStore|null $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Store[] $stores
 * @property-read int|null $stores_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Charge[] $supervisor_charge
 * @property-read int|null $supervisor_charge_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SupplierBill[] $supplierBills
 * @property-read int|null $supplier_bills_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SupplierLog[] $supplierLog
 * @property-read int|null $supplier_log_count
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $supplier_staff
 * @property-read int|null $supplier_staff_count
 * @property-read \Illuminate\Database\Eloquent\Collection|SupplierTransaction[] $supplier_transactions
 * @property-read int|null $supplier_transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|TaskUser[] $tasks
 * @property-read int|null $tasks_count
 * @property-read AccountingJobTitle|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection|FcmToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|RouteTrips[] $trips
 * @property-read int|null $trips_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Charge[] $user_charge
 * @property-read int|null $user_charge_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User ofClient($client_id)
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User permission($permissions)
 * @method static Builder|User query()
 * @method static Builder|User searchByName()
 * @method static Builder|User whereAccountingStoreId($value)
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereAffiliate($value)
 * @method static Builder|User whereBankAccountNumber($value)
 * @method static Builder|User whereBankId($value)
 * @method static Builder|User whereBlockedAt($value)
 * @method static Builder|User whereCarId($value)
 * @method static Builder|User whereCompanyName($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeleteProduct($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereDistributorStatus($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEnable($value)
 * @method static Builder|User whereHiringDate($value)
 * @method static Builder|User whereHolidayBalance($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereImage($value)
 * @method static Builder|User whereIsAccountant($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereIsDistributor($value)
 * @method static Builder|User whereIsSaler($value)
 * @method static Builder|User whereIsStorekeeper($value)
 * @method static Builder|User whereIsSupplier($value)
 * @method static Builder|User whereIsVerified($value)
 * @method static Builder|User whereJob($value)
 * @method static Builder|User whereLat($value)
 * @method static Builder|User whereLng($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNationality($value)
 * @method static Builder|User whereNotes($value)
 * @method static Builder|User whereOrderingCoin($value)
 * @method static Builder|User whereParentUserId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRewordValue($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereSalary($value)
 * @method static Builder|User whereSellCommission($value)
 * @method static Builder|User whereSettleCommission($value)
 * @method static Builder|User whereStoreId($value)
 * @method static Builder|User whereSupplierType($value)
 * @method static Builder|User whereTarget($value)
 * @method static Builder|User whereTaxNumber($value)
 * @method static Builder|User whereTitleId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereVerificationCode($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, softDeletes, HasRoles, HashPassword, FirebasOperation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "phone",
        "email",
        "password",
        "image",
        "job",
        "nationality",
        "company_name",
        "blocked_at",
        "is_admin",
        "remember_token",
        "is_distributor",
        "is_supplier",
        "supplier_type",
        "tex_number",
        "lat",
        "lng",
        "bank_id",
        "verification_code",
        "parent_user_id",
        "bank_account_number",
        "distributor_status",
        "settle_commission",
        "sell_commission",
        "reword_value",
        "store_id",
        "route_id",
        "is_storekeeper",
        "enable",
        "accounting_store_id",
        "is_saler",
        "is_accountant",
        "delete_product",
        "role_id",
        "hiring_date",
        "salary",
        "title_id",
        "is_active",
        "target",
        "affiliate",
        "address",
        "notes",
        "ordering_coin",
        "holiday_balance",
        "is_cash",
        "is_visa",
        "is_deffered",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["password", "remember_token"];

    protected $appends = ["fcm_token_android", "fcm_token_ios"];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
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
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function title(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountingJobTitle::class, "title_id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function user_charge(): HasMany
    {
        return $this->hasMany("App\Models\Charge", "worker_id");
    }

    public function supervisor_charge(): HasMany
    {
        return $this->hasMany("App\Models\Charge", "supervisor_id");
    }

    public function IsDistributor(): bool
    {
        return $this->is_distributor ? 1 : 0;
    }

    public function holidays()
    {
        return $this->belongsToMany(
            AccountingHoliday::class,
            "accounting_holiday_balances",
            "typeable_id",
            "holiday_id"
        )
            ->withPivot("typeable_type", "days", "type", "start_date", "notes")
            ->wherePivot("typeable_type", "employee");
    }

    public function IsSupplier(): bool
    {
        return $this->is_supplier ? 1 : 0;
    }

    public function getTypeAttribute(): string
    {
        if ($this->is_admin == 0) {
            return "عضو";
        }
        return "مدير";
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(FcmToken::class, "user_id");
    }

    /**
     * Block The User.
     *
     * @return void
     */
    public function block()
    {
        if (is_null($this->blocked_at)) {
            $this->forceFill(["blocked_at" => $this->freshTimestamp()])->save();
        }
    }

    public function rate(): float
    {
        $finished_tasks_rate = $this->tasks()
            ->whereMonth("finished_at", date("m"))
            ->whereNotNull("rate")
            ->avg("rate");
        return floatval($finished_tasks_rate);
    }

    /**
     * Determine if a The user has been blocked.
     *
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->blocked_at !== null;
    }

    public function ScopeAvailable(Builder $builder): void
    {
        $builder->whereNull("blocked_at");
    }

    public function ScopeDistributor(Builder $builder): void
    {
        $builder->where("is_distributor", 1);
    }

    public function store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountingStore::class, "accounting_store_id");
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class, "distributor_id");
    }

    public function damaged_store(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Store::class, "distributor_id")->where(
            "for_damaged",
            1
        );
    }

    public function car_store(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Store::class, "distributor_id")
            ->where("car_id", "!=", null)
            ->withDefault(new Store());
    }

    public function updateFcmToken($token, $device)
    {
        FcmToken::updateOrCreate(
            [
                "device" => $device,
                "user_id" => $this->id,
            ],
            [
                "token" => $token,
                "device" => $device,
                "user_id" => $this->id,
            ]
        );
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(TaskUser::class, "user_id");
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, "user_id")->orderBy(
            "created_at",
            "desc"
        );
    }

    public function scopeOfClient(Builder $builder, $client_id)
    {
        $this->whereHas("trips", function ($trip) use ($client_id) {
            $trip->where("client_id", $client_id);
        });
    }

    public function scopeSearchByName(Builder $builder): void
    {
        $builder->where(function ($q) {
            $q->where("name", "Like", "%" . \request("name"));
            $q->orWhere("name", "Like", "%" . \request("name") . "%");
            $q->orWhere("name", "Like", \request("name"));
        });
    }

    /**
     * Send the given notification.
     *
     * @param mixed $instance
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function sendNotification(
        $data,
        $type
    ): \Illuminate\Database\Eloquent\Model {
        return $this->notifications()->create([
            "data" => $data,
            "type" => $type,
        ]);
    }

    /**
     * @param $user_id
     * @return false|float|int
     */
    public function total_message_pages($user_id)
    {
        $messages = Message::with("user")
            ->where([
                "user_id" => auth()->user()->id,
                "receiver_id" => $user_id,
            ])
            ->orWhere(function ($query) use ($user_id) {
                $query->where([
                    "user_id" => $user_id,
                    "receiver_id" => auth()->user()->id,
                ]);
            })
            ->count();

        if ($messages == 0) {
            return 0;
        }
        $pagniation = $this->paginateNumber;
        return ceil($messages / $pagniation);
    }

    public function bank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bank::class, "bank_id");
    }

    public function routes(): HasMany
    {
        return $this->hasMany(DistributorRoute::class, "user_id")->withCount(
            "trips"
        );
    }

    public function trips(): HasManyThrough
    {
        return $this->hasManyThrough(
            RouteTrips::class,
            DistributorRoute::class,
            "user_id",
            "route_id"
        );
    }

    public function accounting_store(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountingStore::class, "accounting_store_id");
    }

    //    ************************************************
    /*
     *
     * @Supplier Functions ....
     *
     */

    public function supplier_staff()
    {
        return $this->hasMany(User::class, "parent_user_id");
    }

    public function supplierLog()
    {
        return $this->hasMany(SupplierLog::class, "user_id");
    }

    public function supplierBills()
    {
        return $this->hasMany(SupplierBill::class, "supplier_id");
    }

    public function supplierProducts()
    {
        $ids = SupplierPrice::where("user_id", $this->id)->pluck("product_id");
        $products = Product::whereIn("id", $ids)->get();
        return $products;
    }

    public function supplierProductsPaginated()
    {
        $ids = SupplierPrice::where("user_id", $this->id)->pluck("product_id");
        $products = Product::whereIn("id", $ids)->paginate(10);
        return $products;
    }

    public function checkIfProductAddedBefore($productId)
    {
        $check = SupplierPrice::where("product_id", $productId)
            ->where("user_id", $this->id)
            ->first();
        if ($check) {
            return 1;
        } else {
            return 0;
        }
    }

    public function supplier_transactions()
    {
        return $this->hasMany(SupplierTransaction::class, "supplier_id");
    }

    public function distributor_transactions()
    {
        return $this->hasMany(DistributorTransaction::class, "user_id");
    }

    public function sender_transactions()
    {
        return $this->morphMany(DistributorTransaction::class, "sender");
    }

    public function supplierTotalBills()
    {
        $amount = $this->supplierBills()->sum("vat");
        $amount += $this->supplierBills()->sum("amount_paid");
        $amount += $this->supplierBills()->sum("amount_rest");
        return $amount;
    }

    public function totalPaidMoneyInBill(): float
    {
        return $amount = $this->supplierBills()->sum("amount_paid");
    }

    public function supplierPaidMoneyInTransactions(): float
    {
        return $this->supplier_transactions()->sum("amount");
    }

    public function supplierTotalPaidMoney(): float
    {
        return $this->totalPaidMoneyInBill() +
            $this->supplierPaidMoneyInTransactions();
    }

    public function totalRestMoneyInBill()
    {
        return $this->supplierBills()->sum("amount_rest");
    }

    public function TotalOfSupplierReceivables(): float
    {
        $amount_rest = $this->totalRestMoneyInBill();
        $paid =
            $this->supplierPaidMoneyInTransactions() +
            $this->totalPaidMoneyInBill();
        return $amount_rest - $paid;
    }

    public function getLastLocationAttribute()
    {
        return optional(
            $this->trips()
                // ->where('status', 'accepted')
                //  ->orderBy('arrange', 'asc')
                ->orderBy("updated_at", "desc")
                ->first()
        );
    }

    //    ******************************************************

    public function all_transactions()
    {
        return DistributorTransaction::UserTransactions($this->id)
            ->walletOf($this->id)
            ->get();
    }

    public function distributor_wallet()
    {
        return round($this->all_transactions()->sum("balance"), 2);
    }

    public function createCarStore($car_id)
    {
        return $this->car_store()->create([
            "name" => [
                "ar" => " سيارة" . $this->name,
                "en" => $this->name . "'s Car",
            ],
            //            'store_category_id' => StoreCategory::first()->id,
            "is_active" => 1,
            "for_distributor" => 1,
            "has_car" => 1,
            "car_id" => $car_id,
        ]);
    }

    /**
     * @return Builder|\Illuminate\Database\Eloquent\Model
     */
    public function createDamageStore()
    {
        return Store::query()->create([
            "name" => [
                "en" => $this->name . "'s damaged store",
                "ar" => $this->name . "مخزن توالف ",
            ],
            "distributor_id" => $this->id,
            "is_active" => 1,
            "for_distributor" => 1,
            "has_car" => 0,
            "for_damaged" => 1,
        ]);
    }

    public function updateCarStore($car_id = null)
    {
        //dd($this->car_store->car_id );
        //remove car if exists
        if ($car_id == null && $this->car_store->car_id != null) {
            $this->car_store->fill(["car_id", null])->save();
        }

        //change car
        if ($car_id != null && $this->car_store->car_id != null) {
            $this->car_store->update([
                "car_id" => $car_id,
            ]);
        }
        //user haven't car ,create new one
        if ($car_id != null && $this->car_store->car_id == null) {
            $car = DistributorCar::find($car_id);
            $this->createCarStore($car->id);
        }
    }

    public function salaries()
    {
        return $this->morphMany(AccountingSalary::class, "typeable");
    }
    public function attendances()
    {
        return $this->morphMany(AccountingAttendance::class, "typeable");
    }
    public function allowances()
    {
        return $this->belongsToMany(
            AccountingAllowance::class,
            "accounting_user_allowances",
            "typeable_id",
            "allowance_id"
        )->withPivot(["value", "typeable_type"]);
    }
    public function debts()
    {
        return $this->hasMany(AccountingDebt::class, "typeable_id");
    }

    public function bonus_discount()
    {
        return $this->morphMany(AccountingBonusDiscount::class, "typeable");
    }
}
