<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingPurchaseItem;

class AccountingPurchaseItemObserver
{
    public function created(AccountingPurchaseItem $item)
    {
        AccountingProductStore::addQuantity(
            product_id: $item->product_id,
            quantity: $item->quantity,
            unit_id: $item->unit_id,
            store_id: $item->product()->value("store_id"),
            price: $item->price_after_tax
        );
    }
}
