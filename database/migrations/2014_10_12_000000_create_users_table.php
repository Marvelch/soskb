<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('account_type')->default('USR')->comment('USR : USER, ADM : ADMIN')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('position_unique')->nullable();
            $table->foreign('position_unique')->references('unique')->on('positions');
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->unsignedBigInteger('sub_customer_type_id')->nullable();
            $table->foreign('sub_customer_type_id')->references('id')->on('sub_customer_types');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
