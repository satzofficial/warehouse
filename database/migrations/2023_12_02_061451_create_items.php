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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('unit')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('upc')->nullable();
            $table->string('ean')->nullable();
            $table->string('weight')->nullable();
            $table->string('brand')->nullable();
            $table->string('mpn')->nullable();
            $table->string('isbn')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('account')->nullable();
            $table->string('description')->nullable();
            $table->string('cost_price')->nullable();
            $table->string('purchase_account')->nullable();
            $table->string('purchase_description')->nullable();
            $table->string('preferred_vendor')->nullable();
            $table->string('opening_stock')->nullable();
            $table->string('opening_stock_rate_per_unit')->nullable();
            $table->string('reorder_point')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
