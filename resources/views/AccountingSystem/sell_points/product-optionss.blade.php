        @foreach ($products as $product)
            <?php
            $producttax = \App\Models\AccountingSystem\AccountingProductTax::where('product_id', $product->id)->first();
            $units = \App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id', $product->id)->get();
            $subunits = collect($units);

            $allunits = json_encode($subunits, JSON_UNESCAPED_UNICODE);
            $mainunits = json_encode(collect([['id' => 'main-' . $product->id, 'name' => $product->main_unit, 'purchasing_price' => $product->purchasing_price, 'product_id' => $product->id, 'bar_code' => $product->bar_code, 'main_unit_present' => 1, 'selling_price' => $product->selling_price, 'created_at' => $product->created_at, 'updated_at' => $product->updated_at, 'quantity' => $product->quantity]]), JSON_UNESCAPED_UNICODE);
            $merged = array_merge(json_decode($mainunits), json_decode($allunits));
            $lastPrice = \App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id', $product->id)
                ->latest()
                ->first();
            ?>
            <option value="{{ $product->id }}" data-main-unit="{{ $product->main_unit }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ $product->selling_price }}"
                    data-bar-code="{{ $product->bar_code }}"
                    data-link="{{ route('accounting.products.show', $product->id) }}"
                    data-price-has-tax="{{ isset($producttax) ? $producttax->price_has_tax : '0' }}"
                    data-total-taxes="{{ isset($producttax) ? $product->total_taxes : '0' }}"
                    data-subunits="{{ json_encode($merged) }}"
                    data-total_discounts="{{ $product->total_discounts }}">
                {{ $product->name }}
            </option>
        @endforeach
