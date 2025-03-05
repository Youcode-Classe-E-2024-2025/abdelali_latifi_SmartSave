<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Ajout de la colonne category_id
        $table->unsignedBigInteger('category_id')->nullable();

        // Définition de la contrainte de clé étrangère
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Suppression de la clé étrangère et de la colonne
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

};
