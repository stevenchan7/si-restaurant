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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained(
                table: 'suppliers', indexName: 'ingredients_suppliers_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('order_logs', function (Blueprint $table) {
            $table->foreignId('ingredient_id')->constrained(
                table: 'ingredients', indexName: 'order_logs_ingredients_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });

        // Schema::table('suppliers', function (Blueprint $table) {
        //     $table->foreignId('inventory_id')->constrained(
        //         table: 'inventories', indexName: 'suppliers_inventories_id'
        //     )->onUpdate('cascade')->onDelete('cascade');
        // });

        Schema::table('menu_ingredients', function (Blueprint $table) {
            $table->foreignId('ingredient_id')->constrained(
                table: 'ingredients', indexName: 'menu_ingredients_ingredients_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });

        //add the menu here

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('order_logs', function (Blueprint $table) {
            $table->dropForeign(['ingredient_id']);
        });

        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        });

        Schema::table('menu_ingredients', function (Blueprint $table) {
            $table->dropForeign(['ingredient_id']);
        });
    }
}; 
?> 

