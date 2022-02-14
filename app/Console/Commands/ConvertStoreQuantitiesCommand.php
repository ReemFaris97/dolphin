<?php

namespace App\Console\Commands;

use App\Models\AccountingSystem\AccountingProductStore;
use Illuminate\Console\Command;

class ConvertStoreQuantitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "convert:store:qunatity";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "convert store quantities from subunits to main unit";

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
        $this->info("converting store quantities from subunits to main unit");
        $storage_quantities = AccountingProductStore::query()
            ->where("unit_id", "!=", null)
            ->get();
        $this->info("total stoke to convert " . count($storage_quantities));
        $bar = $this->output->createProgressBar(count($storage_quantities));

        /** @var \App\Models\AccountingSystem\AccountingProductStore $stoke */
        foreach ($storage_quantities as $stoke) {
            $stoke->quantity =
                $stoke->quantity * ($stoke->unit->main_unit_present ?? 1);
            $stoke->price =
                $stoke->price / ($stoke->unit->main_unit_present ?? 1);
            $stoke->unit_id = null;
            $stoke->save();
            $bar->advance();
        }
        $bar->finish();

        return self::SUCCESS;
    }
}
