<?php

use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supply_requisitions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccountingSupplier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingCompany::class)->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('supply_requisitions');
    }
}
