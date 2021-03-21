<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemplateIdToAccountingTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_templates', function (Blueprint $table) {
            $table->unsignedBigInteger('template_id')->index()->nullable();
            $table->foreign('template_id')->references('id')->on('accounting_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_templates', function (Blueprint $table) {
            //
        });
    }
}
