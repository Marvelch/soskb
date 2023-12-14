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
        Schema::create('sub_customer_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_type_id');
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_customer_types');
    }
};
