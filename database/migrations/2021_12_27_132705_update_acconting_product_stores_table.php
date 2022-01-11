<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccontingProductStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounting_product_stores', function (Blueprint $table) {
<<<<<<< HEAD
            // $table->nullableMorphs('added_from');
            // $table->boolean('type')->default(0)->comment('0=>add ,1=>remove')->change()
            ;
=======
//            $table->nullableMorphs('added_from');
//            $table->boolean('type')->default(0)->comment('0=>add ,1=>remove')->change()
//            ;
>>>>>>> 06c87c9d7921fde4a7e1777d79c9ba5892bb35e8
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounting_product_stores', function (Blueprint $table) {
<<<<<<< HEAD
            // $table->dropMorphs('added_from');
            // $table->dropColumn('type');
=======
//            $table->dropMorphs('added_from');
//            $table->dropColumn('type');
>>>>>>> 06c87c9d7921fde4a7e1777d79c9ba5892bb35e8
        });
    }
}
