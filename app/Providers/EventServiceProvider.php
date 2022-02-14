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
        ChargeCreated::class => [ChargeCode::class],
        ChargeReceived::class => [ChargeReceive::class],
        TaskCreated::class => [
            TaskReceive::class,
            TaskFinish::class,
            TaskRate::class,
        ],
        TaskFinished::class => [\App\Listeners\TaskFinished::class],
        WorkerTaskFinished::class => [
            WorkerTaskFinish::class,
            WorkerTaskRate::class,
        ],
        TaskRated::class => [\App\Listeners\TaskRated::class],
        TaskTransfered::class => [\App\Listeners\TaskTransfer::class],

        \App\Events\StoreTransferRequestAdded::class => [
            \App\Listeners\NotifyTransferRequestReceiver::class,
        ],
        \App\Events\StoreTransferRequestReceiver::class => [
            \App\Listeners\NotifyTransferRequestSender::class,
        ],

        \App\Events\DistributorTransactionAdded::class => [
            \App\Listeners\NotifyTransactionReceiver::class,
        ],
        \App\Events\DistributorTransactionReceived::class => [
            \App\Listeners\NotifyTransactionSender::class,
        ],

        \App\Events\DistributorRouteAdded::class => [
            \App\Listeners\NotifyDistributorWithNewRoute::class,
        ],
        \App\Events\NewStoreAdded::class => [
            \App\Listeners\NotifyDistributorWithNewStore::class,
        ],
        \App\Events\ClientActivationChanged::class => [
            \App\Listeners\NotifyDistributorWithNewActivationStatus::class,
        ],

        \App\Events\MessageCreated::class => [
            \App\Listeners\NotifyMessageReceiver::class,
        ],

        \App\Events\BankDepositConfirmed::class => [
            \App\Listeners\NotifyDistributorConfirmation::class,
        ],

        /** ACCOUNTING EVENTS */
        \App\Events\Accounting\SaleAdded::class => [
            \App\Listeners\Accounting\AddSaleTotalToFund::class,
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
