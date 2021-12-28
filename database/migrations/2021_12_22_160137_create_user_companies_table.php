<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_user_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Supplier\User::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('user_companies');
    }
}
