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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();

            $table->string('free_issue_label');
            $table->string('type');


            $table->string('purchase_product');
            $table->string('free_product');


            $table->integer('purchase_quantity');
            $table->integer('free_quantity');
            $table->integer('lower_limit');
            $table->integer('upper_limit');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
