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
        Schema::create('product_outs', function (Blueprint $table) {
            $table->id('id_product_out');
            $table->integer('total_items');
            $table->foreignId('id_product')->references('product_id')->on('products')->cascadeOnDelete();
            $table->foreignId('id_transaction')->reference('id_transactions')->on('transactions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_outs');
    }
};
