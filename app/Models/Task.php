<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $date
 * @property string|null $time_from
 * @property string|null $equation_mark
 * @property string|null $rate
 * @property string|null $period
 * @property int|null $after_task_id
 * @property int|null $clause_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clause_amount
 * @property int|null $finished_by
 * @property int $user_id
 * @property-read Task|null $afterTask
 * @property-read \App\Models\Clause|null $clause
 * @property-read \App\Models\User $creator
 * @property-read mixed $date_with_time
 * @property-read mixed $is_finished
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskUser[] $task_users
 * @property-read int|null $task_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskLog[] $task_users_logs
 * @property-read int|null $task_users_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskUser[] $user_tasks
 * @property-read int|null $user_tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Task finished($user = null, $mark = '!=', $date = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task future($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task mine($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task old($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Query\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Task present($user_id = null, $assigned_only = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task toFinish($user_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task toRate($user_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereAfterTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereClauseAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereClauseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereEquationMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereFinishedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Task withoutTrashed()
 * @mixin \Eloquent
 */
class Task extends Model
{
    use  SoftDeletes;
    protected $dates = ['date'];
    /*    protected $appends = ['current_user'];*/

    protected $fillable =
        [
            'name', 'type', 'description', 'duration', 'date', 'time_from', 'equation_mark', 'rate', 'period', 'after_task_id', 'clause_id', 'clause_amount',];


    public static $types = ['period' => 'دورية',
        'date' => 'روتينه او مفاجئة',
        'after_task' => 'مهمة تابعة',
        'depends' => 'مهمة مبنية على معادلة'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($task) {
            $task['user_id'] = auth()->user()->id;
        });
        static::updated(function ($task) {
            $task['user_id'] = auth()->user()->id;
        });
    }

    public function afterTask()
    {
        return $this->belongsTo('App\Models\Task', 'after_task_id');
    }

    public function clause()
    {
        return $this->belongsTo('App\Models\Clause', 'clause_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, TaskUser::class, 'task_id', 'user_id')->withPivot('finisher_id', 'rater_id', 'task_duration', 'finished_at', 'rated_at');
    }

    public function task_users()
    {
        return $this->hasMany('App\Models\TaskUser', 'task_id')->with('user', 'rater', 'finisher');
    }

    public function user_tasks()
    {
        return $this->hasMany('App\Models\TaskUser', 'task_id');
    }

    public function task_users_logs()
    {
        return $this->hasMany('App\Models\TaskLog', 'task_id')->with('old_user', 'new_user');
    }

    public function creator()
    {

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function currentTask()
    {
        if ($this->relationLoaded('currentTask')) {
            return $this->currentTask;
        }
        $task_user = $this->user_tasks()->whereNotNull('finished_at')->first();
        if ($task_user) return $task_user;
        foreach ($this->user_tasks as $task_user) {
            if ($task_user->full_date >= new \DateTime(now())) break; else continue;
        }
        return $task_user;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'model');
    }

    public function scopeFinished($query, $user = null, $mark = '!=', $date = null)
    {
        $query->whereHas('task_users', function ($q) use ($user, $mark, $date) {
            $q->where('finished_at', $mark, $date);
            $q->when($user != null, function ($task_user)use ($user) {

                $task_user->where('user_id', $user->id);
                $task_user->where('finisher_id', $user->id);
                $task_user->where('rater_id', $user->id);

            });
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('id', 'desc')->get();
    }

    public function scopePresent($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::where('finished_at', null)

            ->has('task')
            ->when(($user_id != null),
                function ($task_user) use ($user_id, $assigned_only) {
            $task_user->OfUser($user_id,$assigned_only);
                }
            )
            //->whereIn('task_id', [337])
            ->get()
            ->filter('presentFilter');

        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeMine($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->OfUser($user_id,$assigned_only);
        })->has('task')->get();
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }
    public function scopeOld($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::where('finished_at','!=',null)->has('task')->where('worker_finished_at','!=',null)->when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {

            $task_user->OfUser($user_id,$assigned_only);
        })->get()->filter('oldFilter');

        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeFuture($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::where('finished_at',null)->has('task')
            ->where('worker_finished_at',null)
            ->when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->OfUser($user_id,$assigned_only);
        })->get()->filter('futureFilter');
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeToFinish($query, $user_id = null)
    {
        $user_tasks = TaskUser::whereNotNull('worker_finished_at')->whereNull('finished_at')
            ->when(($user_id != null), function ($task_user) use ($user_id) {
       $task_user->where('finisher_id', $user_id);
        })->whereNull('finished_at')->get();
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeToRate($query, $user_id = null)
    {
        $user_tasks = TaskUser::whereNotNull('worker_finished_at')->whereNull('rated_at')->when(($user_id != null), function ($task_user) use ($user_id) {
            $task_user->where('rater_id', $user_id);
        })->whereNull('rated_at')->get();
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }


    public function getDateWithTimeAttribute()
    {

        $date = is_null($this->date) ? $this->created_at->addDays(30)->format('Y-m-d') : $this->date->toDateString();
        $time_from = is_null($this->time_from) ? "00:00:00" : date("H:i:s", strtotime($this->time_from));
        $date_with_time = $date . ' ' . $time_from;
        return Carbon::parse($date_with_time);
    }

    public function getIsFinishedAttribute($query, $user = null, $mark = '!=', $date = null)
    {

    }


    public function taskStatus($id)
    {
        $tasks_pre =  Task::present(auth()->user()->id)->pluck('id')->toArray();
        $tasks_fut=  Task::future(auth()->user()->id)->pluck('id')->toArray();
        $tasks_old =  Task::old(auth()->user()->id)->pluck('id')->toArray();
        $tasks_to_fin =Task::toFinish(auth()->user()->id)->pluck('id')->toArray();
        $tasks_to_rat =Task::toRate(auth()->user()->id)->pluck('id')->toArray();
// dd($tasks_old);
        if (in_array($id,$tasks_pre))
        {
            return "present";
        }

        elseif (in_array($id,$tasks_fut)) {
            return "future";
        }

       elseif (in_array($id,$tasks_old))
            return "old";
        if (in_array($id,$tasks_to_fin))
            return "to_finish";
        if (in_array($id,$tasks_to_rat))
            return "to_rate";
    }

}
