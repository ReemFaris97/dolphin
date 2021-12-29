<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('commercial_number');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('commercial_image')->nullable();
            $table->string('licence_image')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('landline');
            $table->string('credit_limit')->nullable();
            $table->string('credit_date')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
//            $table->foreign('parent_id')->on('suppliers_users')->references('id')->cascadeOnDelete();
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
        Schema::dropIfExists('users');
    }
}
