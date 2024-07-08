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
        Schema::create('supply_order_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('ingredient_price');
            $table->integer('qty');
            $table->float('total_price');
            $table->foreignId('operator_id');
            $table->foreignId('ingredient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_order_logs');
    }
};
