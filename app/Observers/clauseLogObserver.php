<?php

namespace App\Observers;

use App\Models\ClauseLog;
use App\Models\Task;
use Carbon\Carbon;

class clauseLogObserver
{
    /**
     * Handle the clause log "created" event.
     *
     * @param \App\ClauseLog $clauseLog
     * @return void
     */
    public function created(ClauseLog $clauseLog)
    {
        $depends_tasks = Task::where('type', 'depends')
        ->where('clause_id', $clauseLog->clause_id)
            ->whereNull('date')
            ->get();
            foreach ($depends_tasks as $task) {

            $statment = $clauseLog->amount . ' ' . $task->equation_mark . ' ' .  $task->clause_amount . ';';

            if (eval("return $statment ;")) {
                $task->fill(['date' => Carbon::now()])->save();
                $task->save();
            }
        }


    }


}
