<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuIngredientsTable extends Migration
{
    public function up()
    {
        Schema::create('menu_ingredients', function (Blueprint $table) {
            $table->id();
            $table->decimal('ingredient_amount', 8, 2); // Adjust data type based on your needs
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_ingredients');
    }
}
