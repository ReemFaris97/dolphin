
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingOfferNotifactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_notifactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')
                ->on('accounting_clients')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')
                ->on('accounting_packages')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->date('read_at')->nullable();
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
        Schema::dropIfExists('accounting_offer_notifactions');
    }
}
