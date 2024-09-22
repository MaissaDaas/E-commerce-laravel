<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère order_id
            $table->dropForeign(['order_id']);
            // Suppression de la colonne order_id
            $table->dropColumn('order_id');

            // Ajout de la colonne user_id
            $table->unsignedBigInteger('user_id')->nullable();

            // Ajout de la contrainte de clé étrangère user_id
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère user_id
            $table->dropForeign(['user_id']);
            // Suppression de la colonne user_id
            $table->dropColumn('user_id');

            // Ajout de la colonne order_id
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
        });
    }
};
