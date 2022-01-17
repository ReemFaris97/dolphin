<?php

namespace App\Console\Commands;

use App\Models\AccountingSystem\AccountingDevice;
use Illuminate\Console\Command;

class CreateFundForExistDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:funds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $devices=AccountingDevice::query()->whereDoesntHave('fund')
->get();
        $this->withProgressBar($devices, function (AccountingDevice $device) {
            $device->createFund();
        });
        return self::SUCCESS;
    }
}
