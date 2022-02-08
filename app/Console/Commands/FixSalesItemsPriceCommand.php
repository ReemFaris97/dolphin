<?php

namespace App\Console\Commands;

use App\Models\AccountingSystem\AccountingSaleItem;
use Illuminate\Console\Command;

class FixSalesItemsPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fix prices on sales items';

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
        /** @var  \App\Models\AccountingSystem\AccountingSaleItem[] $item */
        $items = AccountingSaleItem::with('product', 'unit')
            ->where('created_at', '>=', '2022-02-08 11:02:49')
            ->get();
        $count = 0;
        foreach ($items as $item) {
            $price =
                $item->unit->selling_price ?? $item->product->selling_price;
            if ($item->price != $price) {
                $count++;
                dump("sale_price={$item->price} ||item=$price");
                $item->update(['price' => $price]);
            }
        }
        dump($count);
    }
}
