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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number');
            $table->string('name');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->unsignedBigInteger('sub_customer_type_id')->nullable();
            $table->foreign('sub_customer_type_id')->references('id')->on('sub_customer_types');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->foreign('changed_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
