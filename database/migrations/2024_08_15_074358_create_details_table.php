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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->string('product_discount')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->string('free_quantity')->nullable();
            $table->integer('order_free')->nullable();
            $table->string('order_discount')->nullable();
            $table->string('net_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
