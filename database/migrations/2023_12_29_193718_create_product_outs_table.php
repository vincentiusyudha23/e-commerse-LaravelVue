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
            $table->id('id');
            $table->integer('total_items');
            $table->foreignId('id_product')->constrained(
                table: 'products', indexName: 'product_outs_products_id'
            );
            $table->foreignId('id_transaction')->constrained(
                table: 'transactions', indexName: 'product_outs_transactions_id'
            )->cascadeOnDelete();
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
