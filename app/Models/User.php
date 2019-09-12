<?php

namespace App;

use App\Http\Traits\FirebasOperation;
use App\Models\Bank;
use App\Models\Charge;
use App\Models\FcmToken;
use App\Models\Message;
use App\Models\Notification;
use App\Models\SupplierLog;
use App\Models\TaskUser;
use App\Traits\ApiResponses;
use App\Traits\HashPassword;
use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Self_;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, softDeletes,HasRoles,HashPassword,FirebasOperation,ApiResponses;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin', 'remember_token'
,'is_distributor','is_supplier','supplier_type','tex_number','lat','lng','bank_id','verification_code','parent_user_id','bank_account_number',

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
        'fcm_token_android','fcm_token_ios'
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


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user_charge()
    {
        return $this->hasMany('App\Models\Charge','worker_id');
    }

    public function supervisor_charge()
    {
        return $this->hasMany('App\Models\Charge','supervisor_id');
    }



    public function IsDistributor():bool
    {

        return $this->is_distributor?1:0;
    }

    public function IsSupplier():bool
    {
        return $this->is_supplier?1:0;
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
        return $this->hasMany(FcmToken::class,'user_id');
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
        $finished_tasks_rate = $this->tasks()->whereMonth('finished_at',date('m'))->whereNotNull('rate')->avg('rate');
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



    public function updateFcmToken($token,$device)
    {
        FcmToken::updateOrCreate([
            'device'=>$device,
            'user_id'=>$this->id,
        ],
            [
                'token'=>$token,
                'device'=>$device,
                'user_id'=>$this->id,
            ]);
    }

    public function tasks()
    {
        return $this->hasMany(TaskUser::class,'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class,'user_id')->orderBy('created_at','desc');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $instance
     * @return void
     */
    public function sendNotification($data, $type)
    {
        $this->notifications()->create([
            'data'=>$data,
            'type'=>$type
        ]);
    }


    public function total_message_pages($user_id)
    {

        $messages= Message::with('user')
            ->where(['user_id'=> auth()->user()->id, 'receiver_id'=> $user_id])
            ->orWhere(function($query) use($user_id){
                $query->where(['user_id' => $user_id, 'receiver_id' => auth()->user()->id]);
            })->count();

        if ($messages == 0) return 0 ;
        $pagniation = $this->paginateNumber;
        return ceil($messages/$pagniation);
    }

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function supplierLog(){
        return $this->hasMany(SupplierLog::class,'user_id');
    }


}
