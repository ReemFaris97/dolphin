<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use  SoftDeletes;
    protected $dates = ['date'];
    /*    protected $appends = ['current_user'];*/

    protected $fillable =
        [
            'name', 'type', 'description', 'duration', 'date', 'time_from', 'equation_mark', 'rate', 'period', 'after_task_id', 'clause_id', 'clause_amount',];


    public static $types = ['period' => 'دورية', 'date' => 'روتينه او مفاجئة', 'after_task' => 'مهمة تابعة', 'depends' => 'مهمة مبنية على معادلة'];

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
        return $this->belongsToMany('App\User', 'task_users', 'task_id', 'user_id')->withPivot('finisher_id', 'rater_id', 'task_duration', 'finished_at', 'reviewed_at', 'rated_at');
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

        return $this->belongsTo('App\User', 'user_id');
    }

    public function currentTask()
    {
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
        $user_tasks = TaskUser::where('finished_at',null)->when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->where('user_id', $user_id);
            if (is_null($assigned_only))
            {
                $task_user->Orwhere('finisher_id', $user_id);
                $task_user->Orwhere('rater_id', $user_id);
            }
        })->get()->filter('presentFilter');
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeMine($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->where('user_id', $user_id);
            if (is_null($assigned_only))
            {
                $task_user->Orwhere('finisher_id', $user_id);
                $task_user->Orwhere('rater_id', $user_id);
            }
        })->get();
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }
    public function scopeOld($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::where('finished_at','!=',null)->where('worker_finished_at','!=',null)->when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->where('user_id', $user_id);
            if (is_null($assigned_only))
            {
                $task_user->Orwhere('finisher_id', $user_id);
                $task_user->Orwhere('rater_id', $user_id);
            }
        })->get()/*->filter('oldFilter')*/;
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeFuture($query, $user_id = null,$assigned_only=null)
    {
        $user_tasks = TaskUser::where('finished_at',null)->where('worker_finished_at',null)->when(($user_id != null), function ($task_user) use ($user_id,$assigned_only) {
            $task_user->where('user_id', $user_id);
            if (is_null($assigned_only))
            {
                $task_user->Orwhere('finisher_id', $user_id);
                $task_user->Orwhere('rater_id', $user_id);
            }
        })->get()->filter('futureFilter');
        $user_tasks_ids = $user_tasks->pluck('task_id');
        return $query->whereIn('id', $user_tasks_ids);
    }

    public function scopeToFinish($query, $user_id = null)
    {
        $user_tasks = TaskUser::whereNotNull('worker_finished_at')->whereNull('finished_at')->when(($user_id != null), function ($task_user) use ($user_id) {
//            $task_user->where('user_id', $user_id);
            $task_user->where('finisher_id', $user_id);
//            $task_user->Orwhere('rater_id', $user_id);
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
        $time_from = is_null($this->time_from) ? "00:00:00" : date("H:i:s", strtotime($this->time_from));;
        $date_with_time = $date . ' ' . $time_from;
        return Carbon::parse($date_with_time);
    }

    public function getIsFinishedAttribute($query, $user = null, $mark = '!=', $date = null)
    {

    }


}
