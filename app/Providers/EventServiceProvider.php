<?php

namespace App\Providers;

use App\Events\ChargeCreated;
use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\TaskFinished;
use App\Events\TaskRated;
use App\Events\TaskTransfered;
use App\Events\WorkerTaskFinished;
use App\Listeners\ChargeCode;
use App\Listeners\ChargeReceive;
use App\Listeners\TaskFinish;
use App\Listeners\TaskRate;
use App\Listeners\TaskReceive;
use App\Listeners\TaskTransfer;
use App\Listeners\WorkerTaskFinish;
use App\Listeners\WorkerTaskRate;
use App\Models\Charge;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ChargeCreated::class => [
            ChargeCode::class,
        ],
        ChargeReceived::class => [
            ChargeReceive::class,
        ],
       TaskCreated::class => [
            TaskFinish::class,
            TaskRate::class,
            TaskReceive::class,
        ],
       TaskFinished::class => [
            \App\Listeners\TaskFinished::class,
        ],
        WorkerTaskFinished::class => [
            WorkerTaskFinish::class,
            WorkerTaskRate::class,
            ],
        TaskRated::class => [
            \App\Listeners\TaskRate::class,
        ],
        TaskTransfered::class => [
            \App\Listeners\TaskTransfer::class,
        ],
        TaskRated::class => [
            \App\Listeners\TaskRated::class,
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
