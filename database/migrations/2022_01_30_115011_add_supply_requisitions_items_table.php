<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplyRequisitionsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_requisition_items',function (Blueprint $table){
           $table->id();
           $table->foreignIdFor(\App\Models\SupplyRequisition::class)->constrained()->cascadeOnDelete();
           $table->foreignIdFor(\App\Models\AccountingSystem\AccountingProduct::class)->constrained()->cascadeOnDelete();
           $table->string('unit');
           $table->unsignedInteger('quantity');
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
        Schema::dropIfExists('supply_requisition_items');
    }
}
