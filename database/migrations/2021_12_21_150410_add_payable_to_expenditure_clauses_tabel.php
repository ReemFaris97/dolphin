<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayableToExpenditureClausesTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenditure_clauses', function (Blueprint $table) {
            $table->unsignedBigInteger('expenditure_type_id')->nullable()->change();
            $table->nullableMorphs('payable');
            $table->unsignedSmallInteger('type')->index()->default(0)->comment('0=>from distrutor ,1=>from supplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenditure_clauses', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn('type');
            $table->dropMorphs('payable');
        });
    }
}
