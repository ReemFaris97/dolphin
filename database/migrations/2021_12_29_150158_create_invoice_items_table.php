<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('suppliers_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Supplier\Invoice::class)->constrained('suppliers_invoices')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingProduct::class)->constrained()->cascadeOnDelete();
            $table->string('unit');
            $table->decimal('price');
            $table->unsignedInteger('quantity');
            $table->decimal('total')->storedAs('(price * quantity) ');
            $table->date('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers_invoice_items');
    }
}
