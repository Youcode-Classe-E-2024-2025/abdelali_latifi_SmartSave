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
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('type', ['income', 'expense'])->change(); 
            $table->string('description')->change(); 
            $table->decimal('amount', 10, 2)->change(); 
            $table->renameColumn('categorie_id', 'category_id'); 
            $table->timestamps(); // Ajouter les timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('type')->change(); 
            $table->string('description')->change();
            $table->float('amount')->change(); 
            $table->renameColumn('category_id', 'categorie_id'); 
            $table->dropTimestamps();
        });
    }
};
