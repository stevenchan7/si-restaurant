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
        // Schema::table('inventories', function (Blueprint $table) {
        //     $table->foreignId('supplier_id')->constrained(
        //         table: 'suppliers', indexName: 'inventories_suppliers_id'
        //     )->onUpdate('cascade')->onDelete('cascade');
        // });

        Schema::table('order_logs', function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained(
                table: 'suppliers', indexName: 'order_logs_suppliers_id'
            )->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('inventory_id')->constrained(
                table: 'inventories', indexName: 'order_logs_inventories_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('inventory_id')->constrained(
                table: 'inventories', indexName: 'suppliers_inventories_id'
            )->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('order_logs', function (Blueprint $table) {
            $table->dropForeign(['supplier_id', 'inventory_id']);
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
        });
    }
}; 
?> 

