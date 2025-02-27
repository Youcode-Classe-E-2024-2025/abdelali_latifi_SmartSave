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
        //
        Schema::create('profiles', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('img');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // Ajouter les timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
