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
        Schema::create('detail_buy', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('buy_id');
            $table->integer('quantity');
            $table->decimal('price_unit', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
            $table->foreign('buy_id')
                ->references('id')
                ->on('buys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_buy');
    }
};
