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
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingCompany::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingSupplier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AccountingSystem\AccountingBranch::class)->constrained()->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\User::class, 'creator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Supplier\User::class, 'approver_id')->nullable()->constrained('suppliers_users')->cascadeOnDelete();

            $table->dateTime('approved_at')->nullable();

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
