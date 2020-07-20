<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewDetailsToAccountingCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_companies', function (Blueprint $table) {

          $table->enum('legal_title',['Corporation','company','another'])->nullable();
          $table->string('another_title')->nullable();
          $table->string('license_number')->nullable();
          $table->string('street')->nullable();
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('postal_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_companies', function (Blueprint $table) {
            //
        });
    }
}
