<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->dropColumn('unit_amount');
            $table->dropColumn('total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('paniers', function (Blueprint $table) {
            $table->decimal('unit_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
        });
    }
};
