<?php

namespace App\Console\Commands;

use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingAssetDamageLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AssetDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assetDay:cron';

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
     * @return mixed
     */
    public function handle()
    {

        $today=Carbon::now();
        $Assets=AccountingAsset::where('damage_period_type','day')->get();
        foreach($Assets as $asset)
        {
                if($today->between($asset->damage_start_date,$asset->damage_end_date)){

                    $lastDamage=AccountingAssetDamageLog::where('asset_id',$asset->id)->latest()->first();
                   
                    AccountingAssetDamageLog::create([
                        'asset_id'=>$asset->id,
                        'code'=>rand(1000,4),
                        'date'=>$today,
                        'amount'=>$asset->damage_price,
                        'amount_asset_after'=>$lastDamage->amount_asset_after-$asset->damage_price
                    ]);

                }
    }


    }
}
