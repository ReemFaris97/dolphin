<?php

namespace App\Providers;

use App\Models\ClauseLog;
use App\Models\Task;
use App\Models\TaskUser;
use App\Observers\clauseLogObserver;
use App\Observers\TaskObserver;
use App\Observers\TaskUserObserver;
use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Relations\Relation;


class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Relation::morphMap([
            'charges' => 'App\Models\Charge',
            'tasks' => 'App\Models\Task',
        ]);
        TaskUser::observe(TaskUserObserver::class);
        ClauseLog::observe(clauseLogObserver::class);
        Task::observe(TaskObserver::class);
    }
}
