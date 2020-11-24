<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsToDistributorTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('distributor_transactions');

        Schema::create('distributor_transactions', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->morphs('sender');
            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('amount');
            $table->enum('type', ['in', 'out'])->default('in');
            $table->boolean('is_received')->default(0);
            $table->string('signature')->nullable();
            $table->softDeletes();
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

        Schema::dropIfExists('distributor_transactions');

        Schema::create('distributor_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('sender_id');
            $table->unsignedbigInteger('receiver_id');
            $table->foreign('sender_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('receiver_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->decimal('amount');
            $table->softDeletes();
            $table->timestamps();
        });
    }
}
