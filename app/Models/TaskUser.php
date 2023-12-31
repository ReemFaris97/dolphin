<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    protected $dates = ['rated_at', 'finished_at'];
    public $fillable = ['comment', 'task_id', 'user_id', 'date', 'finisher_id', 'rater_id', 'task_duration', 'finished_at', 'rated_at', 'rate', 'worker_finished_at'];

    public $appends = ['days', 'hours', 'minutes', 'full_date', 'to_time', 'from_time'];


    public static function findNext($id)
    {
        return static::where('id', '>', $id)->first();
    }

    public function scopeNotFinished($query)
    {
        return $query->where('finished_at',null)->where('worker_finished_at',null);
    }

    public function task()
    {

        return $this->belongsTo('App\Models\Task', 'task_id');
    }

    public function user()
    {

        return $this->belongsTo('App\User', 'user_id');
    }

    public function alternative_user()
    {
        $task = TaskUser::findNext($this->id);
        if ($task) return $task->user->name;
        return "لا يوجد";
    }

    public function rater()
    {

        return $this->belongsTo('App\User', 'rater_id')->withDefault(['name'=>'لا يوجد مقيم']);
    }

    public function finisher()
    {
        return $this->belongsTo('App\User', 'finisher_id')->withDefault(['name'=>'لا يوجد مسئول عن الانتهاء']);
    }


    public function getRestTimeAttribute()
    {
        $current_date  =new \DateTime(date("Y-m-d H:i:s"));
        $end_date  =new \DateTime($this->to_time);
        return $date = $end_date->getTimestamp() - $current_date->getTimestamp();
    }




    public function getDurationAttribute()
    {

        $seconds = $this->task_duration;

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        return $dtF->diff($dtT)->format('%a يوما, %h ساعه, %i دقيقه ');

    }

    public function getDurationArrayAttribute()
    {
        $seconds = $this->task_duration;
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $days = $dtF->diff($dtT)->format('%a');
        $hours = $dtF->diff($dtT)->format('%h');
        $minutes = $dtF->diff($dtT)->format('%i');
        return ['days' => $days, 'hours' => $hours, 'minutes' => $minutes];


    }

    public function getDaysAttribute()
    {
        $seconds = $this->task_duration;
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $days = $dtF->diff($dtT)->format('%a');
        return $days;


    }

    public function getHoursAttribute()
    {
        $seconds = $this->task_duration;
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $hours = $dtF->diff($dtT)->format('%h');
        return $hours;


    }

    public function getMinutesAttribute()
    {
        $seconds = $this->task_duration;
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $minutes = $dtF->diff($dtT)->format('%i');
        return $minutes;
    }


    function getFullDateAttribute()
    {
        $date = $this->task->date;
        $after_date = date('Y-m-d', strtotime($date . ' + ' . $this->days . ' days'));
        $time = $this->hours . ':' . $this->minutes . ':00';
        $combinedDateTime = $after_date . ' ' . $time;
        $time = date("Y-m-d H:i:s", strtotime($combinedDateTime));
        $full_time = new \DateTime($time);
        return $full_time;
    }


    function getTotalDurationAttribute()
    {


        $all_task_users = TaskUser::where('task_id', $this->task_id)->where('id', '<=', $this->id)->orderBy('id', 'asc')->get();


        $all_task_users_duration = $all_task_users->sum('task_duration');


        return $all_task_users_duration;
    }


    function getToTimeAttribute()
    {
        return optional(optional($this->task)->date_with_time)->addSeconds($this->total_duration);

    }

    function getFromTimeAttribute()
    {
        if (optional($this->task)->date_with_time == null) {

            return null;

        }

        return optional($this->task)->date_with_time->addSeconds($this->total_duration)->subSeconds($this->task_duration);
    }

    function getCanFinishAttribute()
    {
        $finished_users = TaskUser::where('task_id', $this->task_id)->where('finished_at', '!=', null)->get();
        $can_finsh = Carbon::now()->between($this->from_time, $this->to_time);
        return ($can_finsh && $finished_users);
    }

    public function getFinishingRateAttribute()
    {
        $duration_quarter = $this->task_duration / 5;
        if ($this->finished_at == null) {
            return "لم تنتهى المهمه";
        }
        $diff_in_Seconds = optional($this->from_time)->diffInSeconds($this->finished_at);
        if ($diff_in_Seconds <= $duration_quarter) {
            return 'ممتاز';
        } elseif ($duration_quarter < $diff_in_Seconds && $diff_in_Seconds <= $duration_quarter * 2) {
            return 'جيد جدا';
        } elseif ($duration_quarter * 2 < $diff_in_Seconds && $diff_in_Seconds <= $duration_quarter * 3) {
            return 'جيد ';
        } elseif ($duration_quarter * 3 < $diff_in_Seconds && $diff_in_Seconds <= $duration_quarter * 4) {
            return 'مقبول ';
        } elseif ($duration_quarter * 4 < $diff_in_Seconds && $diff_in_Seconds <= $duration_quarter * 5) {
            return 'سئ';
        }

    }

}

