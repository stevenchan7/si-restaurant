<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('roles_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        DB::table('roles_user')->insert([
            [
                'user_id' => '1',
                'roles_id' => '1',
            ],
            [
                'user_id' => '2',
                'roles_id' => '2',
            ],
            [
                'user_id' => '3',
                'roles_id' => '3',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_users');
    }
};
