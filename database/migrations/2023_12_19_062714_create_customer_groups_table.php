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
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->unsignedBigInteger('sub_customer_type_id')->nullable();
            $table->foreign('sub_customer_type_id')->references('id')->on('sub_customer_types');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_groups');
    }
};
